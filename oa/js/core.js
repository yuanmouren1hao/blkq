/*
**  HoorayOS开源桌面应用框架
**  作者：胡尐睿丶
**  项目地址：http://code.google.com/p/hoorayos
**  我希望能将这项目继续开源下去，所以请手下留情，保留以上这段版权信息
*/

var version   = '2.0';  //版本号
var ajaxUrl   = 'ajax.php';  //所有ajax操作指向页面
var zoomlevel = 1;
var TEMP      = {};
var HROS      = {};

HROS.CONFIG = {
	desk            : 1,        //当前显示桌面
	dockPos         : 'top',    //应用码头位置，参数有：top,left,right
	appXY           : 'x',      //图标排列方式，参数有：x,y
	appButtonTop    : 20,       //快捷方式top初始位置
	appButtonLeft   : 20,       //快捷方式left初始位置
	createIndexid   : 1,        //z-index初始值
	windowMinWidth  : 215,      //窗口最小宽度
	windowMinHeight : 59,       //窗口最小高度
	wallpaper       : '',       //壁纸
	wallpaperWidth  : 0,        //壁纸宽度
	wallpaperHeight : 0,        //壁纸高度
	wallpaperType   : '',       //壁纸显示类型，参数有：tianchong,shiying,pingpu,lashen,juzhong
	wallpaperState  : 1         //1系统壁纸 2自定义壁纸 3网络壁纸
};

/*
**  图标
*/
HROS.app = (function(){
	return {
		/*
		**  获得图标排列方式，x横向排列，y纵向排列
		*/
		getXY : function(func){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=getAppXY'
			}).done(function(i){
				HROS.CONFIG.appXY = i;
				if(typeof(func) == 'function'){
					func();
				}
			});
		},
		/*
		**  更新图标排列方式
		*/
		updateXY : function(i, func){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=setAppXY&appxy=' + i
			}).done(function(){
				HROS.CONFIG.appXY = i;
				if(typeof(func) == 'function'){
					func();
				}
			});
		},
		/*
		**  获取图标
		*/
		get : function(){
			//绘制图标表格
			var grid = HROS.grid.getAppGrid(), dockGrid = HROS.grid.getDockAppGrid();
			//获取json数组并循环输出每个图标
			$.getJSON(ajaxUrl + '?ac=getMyApp', function(sc){
				//加载应用码头图标
				if(sc['dock'] != null){
					var dock_append = '', temp = {};
					for(var i = 0; i < sc['dock'].length; i++){
						dock_append += appbtnTemp({
							'top' : dockGrid[i]['startY'],
							'left' : dockGrid[i]['startX'],
							'title' : sc['dock'][i]['name'],
							'type' : sc['dock'][i]['type'],
							'id' : 'd_' + sc['dock'][i]['type'] + '_' + sc['dock'][i]['id'],
							'realid' : sc['dock'][i]['id'],
							'imgsrc' : sc['dock'][i]['icon']
						});
					}
					$('#dock-bar .dock-applist').html('').append(dock_append);
				}
				//加载桌面图标
				for(var j = 1; j <= 5; j++){
					var desk_append = '', temp = {};
					if(sc['desk' + j] != null){
						for(var i = 0; i < sc['desk' + j].length; i++){
							desk_append += appbtnTemp({
								'top' : grid[i]['startY'] + 7,
								'left' : grid[i]['startX'] + 16,
								'title' : sc['desk' + j][i]['name'],
								'type' : sc['desk' + j][i]['type'],
								'id' : 'd_' + sc['desk' + j][i]['type'] + '_' + sc['desk' + j][i]['id'],
								'realid' : sc['desk' + j][i]['id'],
								'imgsrc' : sc['desk' + j][i]['icon']
							});
						}
					}
					desk_append += addbtnTemp({
						'top' : grid[i]['startY'] + 7,
						'left' : grid[i]['startX'] + 16
					});
					$('#desk-' + j + ' li').remove();
					$('#desk-' + j).append(desk_append);
					i = 0;
				}
				//绑定'应用市场'图标点击事件
				$('#desk').off('click').on('click', 'li.add', function(){
					HROS.window.createTemp({
						id : 'yysc',
						title : '应用市场',
						url : 'sysapp/appmarket/index.php',
						width : 800,
						height : 484,
						isresize : false,
						isflash : false
					});
				});
				//绑定图标拖动事件
				HROS.app.move();
				//绑定应用码头拖动事件
				HROS.dock.move();
				//加载滚动条
				HROS.app.getScrollbar();
				//绑定滚动条拖动事件
				HROS.app.moveScrollbar();
				//绑定图标右击事件
				$('#desk').on('contextmenu', '.appbtn:not(.add)', function(e){
					$('.popup-menu').hide();
					$('.quick_view_container').remove();
					switch($(this).attr('type')){
						case 'app':
						case 'widget':
							var popupmenu = HROS.popupMenu.app($(this));
							break;
						case 'papp':
						case 'pwidget':
							var popupmenu = HROS.popupMenu.papp($(this));
							break;
						case 'folder':
							var popupmenu = HROS.popupMenu.folder($(this));
							break;
					}
					var l = ($(document).width() - e.clientX) < popupmenu.width() ? (e.clientX - popupmenu.width()) : e.clientX;
					var t = ($(document).height() - e.clientY) < popupmenu.height() ? (e.clientY - popupmenu.height()) : e.clientY;
					popupmenu.css({
						left : l,
						top : t
					}).show();
					return false;
				});
			});
		},
		/*
		**  添加应用
		*/
		add : function(id, type, fun){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=addMyApp&id=' + id  + '&type=' + type + '&desk=' + HROS.CONFIG.desk,
				success : function(){
					if(typeof(fun) !== 'undefined'){
						fun();
					}
				}
			}); 
		},
		/*
		**  删除应用
		*/
		remove : function(id, type, fun){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=delMyApp&id=' + id + '&type=' + type,
				success : function(){
					if(type == 'widget'){
						HROS.widget.removeCookie(id, type);
					}
					if(typeof(fun) !== 'undefined'){
						fun();
					}
				}
			});
		},
		/*
		**  图标拖动、打开
		**  这块代码略多，主要处理了9种情况下的拖动，分别是：
		**  桌面拖动到应用码头、桌面拖动到文件夹内、当前桌面上拖动(排序)
		**  应用码头拖动到桌面、应用码头拖动到文件夹内、应用码头上拖动(排序)
		**  文件夹内拖动到桌面、文件夹内拖动到应用码头、不同文件夹之间拖动
		*/
		move : function(){
			//应用码头图标拖动
			$('#dock-bar .dock-applist').off('mousedown', 'li').on('mousedown', 'li', function(e){
				e.preventDefault();
				e.stopPropagation();
				if(e.button == 0 || e.button == 1){
					var oldobj = $(this), x, y, cx, cy, dx, dy, lay, obj = $('<li id="shortcut_shadow">' + oldobj.html() + '</li>');
					dx = cx = e.clientX;
					dy = cy = e.clientY;
					x = dx - oldobj.offset().left;
					y = dy - oldobj.offset().top;
					//绑定鼠标移动事件
					$(document).on('mousemove', function(e){
						$('body').append(obj);
						lay = HROS.maskBox.desk();
						lay.show();
						cx = e.clientX <= 0 ? 0 : e.clientX >= $(document).width() ? $(document).width() : e.clientX;
						cy = e.clientY <= 0 ? 0 : e.clientY >= $(document).height() ? $(document).height() : e.clientY;
						_l = cx - x;
						_t = cy - y;
						if(dx != cx || dy != cy){
							obj.css({
								left : _l,
								top : _t
							}).show();
						}
					}).on('mouseup', function(){
						$(document).off('mousemove').off('mouseup');
						obj.remove();
						if(typeof(lay) !== 'undefined'){
							lay.hide();
						}
						//判断是否移动图标，如果没有则判断为click事件
						if(dx == cx && dy == cy){
							switch(oldobj.attr('type')){
								case 'app':
								case 'papp':
									HROS.window.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
								case 'widget':
								case 'pwidget':
									HROS.widget.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
								case 'folder':
									HROS.folderView.init(oldobj);
									break;
							}
							return false;
						}
						var folderId = HROS.grid.searchFolderGrid(cx, cy);
						if(folderId != null){
							if(oldobj.hasClass('folder') == false){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updateMyApp&movetype=dock-folder&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.index() + '&to=' + folderId + '&desk=' + HROS.CONFIG.desk,
									success : function(){
										oldobj.remove();
										HROS.deskTop.appresize();
										//如果文件夹预览面板为显示状态，则进行更新
										if($('#qv_' + folderId).length != 0){
											HROS.folderView.init($('#d_folder_' + folderId));
										}
										//如果文件夹窗口为显示状态，则进行更新
										if($('#w_folder_' + folderId).length != 0){
											HROS.window.updateFolder(folderId, 'folder');
										}
									}
								});
							}
						}else{
							var icon, icon2;
							var iconIndex = $('#desk-' + HROS.CONFIG.desk + ' li.appbtn:not(.add)').length == 0 ? -1 : $('#desk-' + HROS.CONFIG.desk + ' li').index(oldobj);
							var iconIndex2 = $('#dock-bar .dock-applist').html() == '' ? -1 : $('#dock-bar .dock-applist li').index(oldobj);
							
							var dock_w2 = HROS.CONFIG.dockPos == 'left' ? 0 : HROS.CONFIG.dockPos == 'top' ? ($(window).width() - $('#dock-bar .dock-applist').width() - 20) / 2 : $(window).width() - $('#dock-bar .dock-applist').width();
							var dock_h2 = HROS.CONFIG.dockPos == 'top' ? 0 : ($(window).height() - $('#dock-bar .dock-applist').height() - 20) / 2;
							icon2 = HROS.grid.searchDockAppGrid(cx - dock_w2, cy - dock_h2);
							if(icon2 != null && icon2 != oldobj.index()){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updateMyApp&movetype=dock-dock&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.index() + '&to=' + icon2 + '&desk=' + HROS.CONFIG.desk,
									success : function(){
										if(icon2 < iconIndex2){
											$('#dock-bar .dock-applist li:eq(' + icon2 + ')').before(oldobj);
										}else if(icon2 > iconIndex2){
											$('#dock-bar .dock-applist li:eq(' + icon2 + ')').after(oldobj);
										}
										HROS.deskTop.appresize();
									}
								});
							}else{
								var dock_w = HROS.CONFIG.dockPos == 'left' ? 73 : 0;
								var dock_h = HROS.CONFIG.dockPos == 'top' ? 73 : 0;
								icon = HROS.grid.searchAppGrid(cx - dock_w, cy - dock_h);
								if(icon != null){
									$.ajax({
										type : 'POST',
										url : ajaxUrl,
										data : 'ac=updateMyApp&movetype=dock-desk&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.index() + '&to=' + (icon + 1) + '&desk=' + HROS.CONFIG.desk,
										success : function(){
											if(icon < iconIndex){
												$('#desk-' + HROS.CONFIG.desk + ' li:not(.add):eq(' + icon + ')').before(oldobj);
											}else if(icon > iconIndex){
												$('#desk-' + HROS.CONFIG.desk + ' li:not(.add):eq(' + icon + ')').after(oldobj);
											}else{
												if(iconIndex == -1){
													$('#desk-' + HROS.CONFIG.desk + ' li.add').before(oldobj);
												}
											}
											HROS.deskTop.appresize();
										}
									});
								}
							}
						}
					});
				}
				return false;
			});
			//桌面图标拖动
			$('#desk .desktop-container').off('mousedown', 'li:not(.add)').on('mousedown', 'li:not(.add)', function(e){
				e.preventDefault();
				e.stopPropagation();
				if(e.button == 0 || e.button == 1){
					var oldobj = $(this), x, y, cx, cy, dx, dy, lay, obj = $('<li id="shortcut_shadow">' + oldobj.html() + '</li>');
					dx = cx = e.clientX;
					dy = cy = e.clientY;
					x = dx - oldobj.offset().left;
					y = dy - oldobj.offset().top;
					//绑定鼠标移动事件
					$(document).on('mousemove', function(e){
						$('body').append(obj);
						lay = HROS.maskBox.desk();
						lay.show();
						cx = e.clientX <= 0 ? 0 : e.clientX >= $(document).width() ? $(document).width() : e.clientX;
						cy = e.clientY <= 0 ? 0 : e.clientY >= $(document).height() ? $(document).height() : e.clientY;
						_l = cx - x;
						_t = cy - y;
						if(dx != cx || dy != cy){
							obj.css({
								left : _l,
								top : _t
							}).show();
						}
					}).on('mouseup', function(){
						$(document).off('mousemove').off('mouseup');
						obj.remove();
						if(typeof(lay) !== 'undefined'){
							lay.hide();
						}
						//判断是否移动图标，如果没有则判断为click事件
						if(dx == cx && dy == cy){
							switch(oldobj.attr('type')){
								case 'app':
								case 'papp':
									HROS.window.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
								case 'widget':
								case 'pwidget':
									HROS.widget.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
								case 'folder':
									HROS.folderView.init(oldobj);
									break;
							}
							return false;
						}
						var folderId = HROS.grid.searchFolderGrid(cx, cy);
						if(folderId != null){
							if(oldobj.attr('type') != 'folder'){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updateMyApp&movetype=desk-folder&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + (oldobj.index() - 2) + '&to=' + folderId + '&desk=' + HROS.CONFIG.desk,
									success : function(){
										oldobj.remove();
										HROS.deskTop.appresize();
										//如果文件夹预览面板为显示状态，则进行更新
										if($('#qv_' + folderId).length != 0){
											HROS.folderView.init($('#d_folder_' + folderId));
										}
										//如果文件夹窗口为显示状态，则进行更新
										if($('#w_folder_' + folderId).length != 0){
											HROS.window.updateFolder(folderId, 'folder');
										}
									}
								});
							}
						}else{
							var icon, icon2;
							var iconIndex = $('#desk-' + HROS.CONFIG.desk + ' li.appbtn:not(.add)').length == 0 ? -1 : $('#desk-' + HROS.CONFIG.desk + ' li').index(oldobj);
							var iconIndex2 = $('#dock-bar .dock-applist').html() == '' ? -1 : $('#dock-bar .dock-applist li').index(oldobj);
							
							var dock_w2 = HROS.CONFIG.dockPos == 'left' ? 0 : HROS.CONFIG.dockPos == 'top' ? ($(window).width() - $('#dock-bar .dock-applist').width() - 20) / 2 : $(window).width() - $('#dock-bar .dock-applist').width();
							var dock_h2 = HROS.CONFIG.dockPos == 'top' ? 0 : ($(window).height()-$('#dock-bar .dock-applist').height() - 20) / 2;
							icon2 = HROS.grid.searchDockAppGrid(cx - dock_w2, cy - dock_h2);
							if(icon2 != null){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updateMyApp&movetype=desk-dock&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + (oldobj.index() - 2) + '&to=' + (icon2 + 1) + '&desk=' + HROS.CONFIG.desk,
									success : function(){
										if(icon2 < iconIndex2){
											$('#dock-bar .dock-applist li:eq(' + icon2 + ')').before(oldobj);
										}else if(icon2 > iconIndex2){
											$('#dock-bar .dock-applist li:eq(' + icon2 + ')').after(oldobj);
										}else{
											if(iconIndex2 == -1){
												$('#dock-bar .dock-applist').append(oldobj);
											}
										}
										if($('#dock-bar .dock-applist li').length > 7){
											$('#desk-' + HROS.CONFIG.desk + ' li.add').before($('#dock-bar .dock-applist li').last());
										}
										HROS.deskTop.appresize();
									}
								});
							}else{
								var dock_w = HROS.CONFIG.dockPos == 'left' ? 73 : 0;
								var dock_h = HROS.CONFIG.dockPos == 'top' ? 73 : 0;
								icon = HROS.grid.searchAppGrid(cx - dock_w, cy - dock_h);
								if(icon != null && icon != (oldobj.index() - 2)){
									$.ajax({
										type : 'POST',
										url : ajaxUrl,
										data : 'ac=updateMyApp&movetype=desk-desk&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + (oldobj.index() - 2) + '&to=' + icon + '&desk=' + HROS.CONFIG.desk,
										success : function(){
											if(icon < iconIndex){
												$('#desk-' + HROS.CONFIG.desk + ' li:not(.add):eq(' + icon + ')').before(oldobj);
											}else if(icon > iconIndex){
												$('#desk-' + HROS.CONFIG.desk + ' li:not(.add):eq(' + icon + ')').after(oldobj);
											}else{
												if(iconIndex == -1){
													$('#desk-' + HROS.CONFIG.desk + ' li.add').before(oldobj);
												}
											}
											HROS.deskTop.appresize();
										}
									});
								}
							}
						}
					});
				}
			});
			//文件夹内图标拖动
			$('.folder_body, .quick_view_container').off('mousedown', 'li').on('mousedown', 'li', function(e){
				e.preventDefault();
				e.stopPropagation();
				if(e.button == 0 || e.button == 1){
					var oldobj = $(this), x, y, cx, cy, dx, dy, lay, obj = $('<li id="shortcut_shadow">' + oldobj.html() + '</li>');
					dx = cx = e.clientX;
					dy = cy = e.clientY;
					x = dx - oldobj.offset().left;
					y = dy - oldobj.offset().top;
					//绑定鼠标移动事件
					$(document).on('mousemove', function(e){
						$('body').append(obj);
						lay = HROS.maskBox.desk();
						lay.show();
						cx = e.clientX <= 0 ? 0 : e.clientX >= $(document).width() ? $(document).width() : e.clientX;
						cy = e.clientY <= 0 ? 0 : e.clientY >= $(document).height() ? $(document).height() : e.clientY;
						_l = cx - x;
						_t = cy - y;
						if(dx != cx || dy != cy){
							obj.css({
								left : _l,
								top : _t
							}).show();
						}
					}).on('mouseup', function(){
						$(document).off('mousemove').off('mouseup');
						obj.remove();
						if(typeof(lay) !== 'undefined'){
							lay.hide();
						}
						//判断是否移动图标，如果没有则判断为click事件
						if(dx == cx && dy == cy){
							switch(oldobj.attr('type')){
								case 'app':
								case 'papp':
									HROS.window.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
								case 'widget':
								case 'pwidget':
									HROS.widget.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
							}
							return false;
						}
						var folderId = HROS.grid.searchFolderGrid(cx, cy);
						if(folderId != null){
							if(oldobj.parents('.folder-window').attr('realid') != folderId){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updateMyApp&movetype=folder-folder&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.parents('.folder-window').attr('realid') + '&to=' + folderId + '&desk=' + HROS.CONFIG.desk,
									success : function(){
										oldobj.remove();
										HROS.deskTop.appresize();
										//如果文件夹预览面板为显示状态，则进行更新
										if($('#qv_' + folderId).length != 0){
											HROS.folderView.init($('#d_folder_' + folderId));
										}
										//如果文件夹窗口为显示状态，则进行更新
										if($('#w_folder_' + folderId).length != 0){
											HROS.window.updateFolder(folderId, 'folder');
										}
									}
								});
							}
						}else{
							var icon, icon2;
							var iconIndex = $('#desk-' + HROS.CONFIG.desk + ' li.appbtn:not(.add)').length == 0 ? -1 : $('#desk-' + HROS.CONFIG.desk + ' li').index(oldobj);
							var iconIndex2 = $('#dock-bar .dock-applist').html() == '' ? -1 : $('#dock-bar .dock-applist li').index(oldobj);
							
							var dock_w2 = HROS.CONFIG.dockPos == 'left' ? 0 : HROS.CONFIG.dockPos == 'top' ? ($(window).width() - $('#dock-bar .dock-applist').width() - 20) / 2 : $(window).width() - $('#dock-bar .dock-applist').width();
							var dock_h2 = HROS.CONFIG.dockPos == 'top' ? 0 : ($(window).height() - $('#dock-bar .dock-applist').height() - 20) / 2;
							icon2 = HROS.grid.searchDockAppGrid(cx - dock_w2, cy - dock_h2);
							if(icon2 != null){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updateMyApp&movetype=folder-dock&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.parents('.folder-window').attr('realid') + '&to=' + (icon2 + 1) + '&desk=' + HROS.CONFIG.desk,
									success : function(){
										var folderId = oldobj.parents('.folder-window').attr('realid');
										if(icon2 < iconIndex2){
											$('#dock-bar .dock-applist li.appbtn:not(.add):eq(' + icon2 + ')').before(oldobj);
										}else if(icon2 > iconIndex2){
											$('#dock-bar .dock-applist li.appbtn:not(.add):eq(' + icon2 + ')').after(oldobj);
										}else{
											if(iconIndex2 == -1){
												$('#dock-bar .dock-applist').append(oldobj);
											}
										}
										if($('#dock-bar .dock-applist li').length > 7){
											$('#desk-' + HROS.CONFIG.desk + ' li.add').before($('#dock-bar .dock-applist li').last());
										}
										HROS.deskTop.appresize();
										//如果文件夹预览面板为显示状态，则进行更新
										if($('#qv_' + folderId).length != 0){
											HROS.folderView.init($('#d_folder_' + folderId));
										}
										//如果文件夹窗口为显示状态，则进行更新
										if($('#w_folder_' + folderId).length != 0){
											HROS.window.updateFolder(folderId, 'folder');
										}
									}
								});
							}else{
								var dock_w = HROS.CONFIG.dockPos == 'left' ? 73 : 0;
								var dock_h = HROS.CONFIG.dockPos == 'top' ? 73 : 0;
								icon = HROS.grid.searchAppGrid(cx - dock_w, cy - dock_h);
								if(icon != null){
									$.ajax({
										type : 'POST',
										url : ajaxUrl,
										data : 'ac=updateMyApp&movetype=folder-desk&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.parents('.folder-window').attr('realid') + '&to=' + (icon + 1) + '&desk=' + HROS.CONFIG.desk,
										success : function(){
											var folderId = oldobj.parents('.folder-window').attr('realid');
											if(icon < iconIndex){
												$('#desk-' + HROS.CONFIG.desk + ' li.appbtn:not(.add):eq(' + icon + ')').before(oldobj);
											}else if(icon > iconIndex){
												$('#desk-' + HROS.CONFIG.desk + ' li.appbtn:not(.add):eq(' + icon + ')').after(oldobj);
											}else{
												if(iconIndex == -1){
													$('#desk-' + HROS.CONFIG.desk + ' li.add').before(oldobj);
												}
											}
											HROS.deskTop.appresize();
											//如果文件夹预览面板为显示状态，则进行更新
											if($('#qv_' + folderId).length != 0){
												HROS.folderView.init($('#d_folder_' + folderId));
											}
											//如果文件夹窗口为显示状态，则进行更新
											if($('#w_folder_' + folderId).length != 0){
												HROS.window.updateFolder(folderId, 'folder');
											}
										}
									});
								}
							}
						}
					});
				}
			});
		},
		/*
		**  加载滚动条
		*/
		getScrollbar : function(){
			setTimeout(function(){
				$('#desk .desktop-container').each(function(){
					var desk = $(this), scrollbar = desk.children('.scrollbar');
					//先清空所有附加样式
					scrollbar.hide();
					desk.scrollLeft(0).scrollTop(0);
					/*
					**  判断图标排列方式
					**  横向排列超出屏幕则出现纵向滚动条，纵向排列超出屏幕则出现横向滚动条
					*/
					if(HROS.CONFIG.appXY == 'x'){
						/*
						**  获得桌面图标定位好后的实际高度
						**  因为显示的高度是固定的，而实际的高度是根据图标个数会变化
						*/
						var deskH = parseInt(desk.children('.add').css('top')) + 108;
						/*
						**  计算滚动条高度
						**  高度公式（图标纵向排列计算滚动条宽度以此类推）：
						**  滚动条实际高度 = 桌面显示高度 / 桌面实际高度 * 滚动条总高度(桌面显示高度)
						**  如果“桌面显示高度 / 桌面实际高度 >= 1”说明图标个数未能超出桌面，则不需要出现滚动条
						*/
						if(desk.height() / deskH < 1){
							desk.children('.scrollbar-y').height(desk.height() / deskH * desk.height()).css('top',0).show();
						}
					}else{
						var deskW = parseInt(desk.children('.add').css('left')) + 106;
						if(desk.width() / deskW < 1){
							desk.children('.scrollbar-x').width(desk.width() / deskW * desk.width()).css('left',0).show();
						}
					}
				});
			},500);
		},
		/*
		**  移动滚动条
		*/
		moveScrollbar : function(){
			/*
			**  手动拖动
			*/
			$('.scrollbar').on('mousedown', function(e){
				var x, y, cx, cy, deskrealw, deskrealh, movew, moveh;
				var scrollbar = $(this), desk = scrollbar.parent('.desktop-container');
				deskrealw = parseInt(desk.children('.add').css('left')) + 106;
				deskrealh = parseInt(desk.children('.add').css('top')) + 108;
				movew = desk.width() - scrollbar.width();
				moveh = desk.height() - scrollbar.height();
				if(scrollbar.hasClass('scrollbar-x')){
					x = e.clientX - scrollbar.offset().left;
				}else{
					y = e.clientY - scrollbar.offset().top;
				}
				$(document).on('mousemove', function(e){
					if(scrollbar.hasClass('scrollbar-x')){
						if(HROS.CONFIG.dockPos == 'left'){
							cx = e.clientX - x - 73 < 0 ? 0 : e.clientX - x - 73 > movew ? movew : e.clientX - x - 73;
						}else{
							cx = e.clientX - x < 0 ? 0 : e.clientX - x > movew ? movew : e.clientX - x;
						}
						scrollbar.css('left', cx / desk.width() * deskrealw + cx);
						desk.scrollLeft(cx / desk.width() * deskrealw);
					}else{
						if(HROS.CONFIG.dockPos == 'top'){
							cy = e.clientY - y - 73 < 0 ? 0 : e.clientY - y - 73 > moveh ? moveh : e.clientY - y - 73;
						}else{
							cy = e.clientY - y < 0 ? 0 : e.clientY - y > moveh ? moveh : e.clientY - y;
						}
						scrollbar.css('top', cy / desk.height() * deskrealh + cy);
						desk.scrollTop(cy / desk.height() * deskrealh);
					}
				}).on('mouseup', function(){
					$(this).off('mousemove').off('mouseup');
				});
			});
			/*
			**  鼠标滚轮
			**  只支持纵向滚动条
			*/
			$('#desk .desktop-container').each(function(i){
				$('#desk-' + (i + 1)).on('mousewheel', function(event, delta){
					var desk = $(this), deskrealh = parseInt(desk.children('.add').css('top')) + 108, scrollupdown;
					/*
					**  delta == -1   往下
					**  delta == 1    往上
					**  chrome下鼠标滚轮每滚动一格，页面滑动距离是200px，所以下面也用这个值来模拟每次滑动的距离
					*/
					if(delta < 0){
						scrollupdown = desk.scrollTop() + 200 > deskrealh - desk.height() ? deskrealh - desk.height() : desk.scrollTop() + 200;
					}else{
						scrollupdown = desk.scrollTop() - 200 < 0 ? 0 : desk.scrollTop() - 200;
					}
					desk.stop(false, true).animate({scrollTop:scrollupdown},300);
					desk.children('.scrollbar-y').stop(false, true).animate({
						top : scrollupdown / deskrealh * desk.height() + scrollupdown
					}, 300);
				});
			});
		}
	}
})();

/*
**  全局视图
*/
HROS.appmanage = (function(){
	return {
		init : function(){
			$('#amg_dock_container').html('').append($('#dock-container .dock-applist li').clone());
			$('#desk .desktop-container').each(function(i){
				$('#amg_folder_container .folderItem:eq(' + i + ') .folderInner').html('');
				$(this).children('.appbtn:not(.add)').each(function(){
					$('#amg_folder_container .folderItem:eq(' + i + ') .folderInner').append($(this).clone());
				});
			});
			$('#desktop').hide();
			$('#appmanage').show();
			$('#amg_folder_container .folderItem').show().addClass('folderItem_turn');
			$('#amg_folder_container').height($(document).height() - 80);
			$('#appmanage .amg_close').off('click').on('click', function(){
				HROS.appmanage.close();
			});
			HROS.appmanage.appresize();
			HROS.appmanage.move();
			HROS.appmanage.getScrollbar();
			HROS.appmanage.moveScrollbar();
		},
		getScrollbar : function(){
			setTimeout(function(){
				$('#amg_folder_container .folderItem').each(function(){
					var desk = $(this).find('.folderInner'), deskrealh = parseInt(desk.children('.shortcut:last').css('top')) + 41, scrollbar = desk.next('.scrollBar');
					//先清空所有附加样式
					scrollbar.hide();
					desk.scrollTop(0);
					if(desk.height() / deskrealh < 1){
						scrollbar.height(desk.height() / deskrealh * desk.height()).css('top',0).show();
					}
				});
			},500);
		},
		moveScrollbar : function(){
			/*
			**  手动拖动
			*/
			$('.scrollBar').on('mousedown', function(e){
				var y, cy, deskrealh, moveh;
				var scrollbar = $(this), desk = scrollbar.prev('.folderInner');
				deskrealh = parseInt(desk.children('.shortcut:last').css('top')) + 41;
				moveh = desk.height() - scrollbar.height();
				y = e.clientY - scrollbar.offset().top;
				$(document).on('mousemove', function(e){
					//减80px是因为顶部dock区域的高度为80px，所以计算移动距离需要先减去80px
					cy = e.clientY - y - 80 < 0 ? 0 : e.clientY - y - 80 > moveh ? moveh : e.clientY - y - 80;
					scrollbar.css('top', cy);
					desk.scrollTop(cy / desk.height() * deskrealh);
				}).on('mouseup', function(){
					$(this).off('mousemove').off('mouseup');
				});
			});
			/*
			**  鼠标滚轮
			*/
			$('#amg_folder_container .folderInner').off('mousewheel').on('mousewheel', function(event, delta){
				var desk = $(this), deskrealh = parseInt(desk.children('.shortcut:last').css('top')) + 41, scrollupdown;
				/*
				**  delta == -1   往下
				**  delta == 1    往上
				*/
				if(delta < 0){
					scrollupdown = desk.scrollTop() + 120 > deskrealh - desk.height() ? deskrealh - desk.height() : desk.scrollTop() + 120;
				}else{
					scrollupdown = desk.scrollTop() - 120 < 0 ? 0 : desk.scrollTop() - 120;
				}
				desk.stop(false, true).animate({
					scrollTop : scrollupdown
				}, 300);
				desk.next('.scrollBar').stop(false, true).animate({
					top : scrollupdown / deskrealh * desk.height()
				}, 300);
			});
		},
		resize : function(){
			$('#amg_folder_container').height($(document).height() - 80);
			HROS.appmanage.getScrollbar();
		},
		appresize : function(){
			var manageDockGrid = HROS.grid.getManageDockAppGrid();
			$('#amg_dock_container li').each(function(i){
				$(this).animate({
					'left' : manageDockGrid[i]['startX'],
					'top' : 10
				}, 500);
			});
			for(var i = 0; i < 5; i++){
				var manageAppGrid = HROS.grid.getManageAppGrid();
				$('#amg_folder_container .folderItem:eq(' + i + ') .folderInner li').each(function(j){
					$(this).animate({
						'left' : 0,
						'top' : manageAppGrid[j]['startY']
					}, 500).attr('desk', i);
				});
			}
		},
		close : function(){
			$('#amg_dock_container').html('');
			$('#amg_folder_container .folderInner').html('');
			$('#desktop').show();
			$('#appmanage').hide();
			$('#amg_folder_container .folderItem').removeClass('folderItem_turn');
			HROS.app.get();
		},
		move : function(){
			$('#amg_dock_container').off('mousedown').on('mousedown', 'li', function(e){
				e.preventDefault();
				e.stopPropagation();
				if(e.button == 0 || e.button == 1){
					var oldobj = $(this), x, y, cx, cy, dx, dy, lay, obj = $('<li id="shortcut_shadow">' + oldobj.html() + '</li>');
					dx = cx = e.clientX;
					dy = cy = e.clientY;
					x = dx - oldobj.offset().left;
					y = dy - oldobj.offset().top;
					//绑定鼠标移动事件
					$(document).on('mousemove', function(e){
						$('body').append(obj);
						lay = HROS.maskBox.desk();
						lay.show();
						cx = e.clientX <= 0 ? 0 : e.clientX >= $(document).width() ? $(document).width() : e.clientX;
						cy = e.clientY <= 0 ? 0 : e.clientY >= $(document).height() ? $(document).height() : e.clientY;
						_l = cx - x;
						_t = cy - y;
						if(dx != cx || dy != cy){
							obj.css({
								left : _l,
								top : _t
							}).show();
						}
					}).on('mouseup', function(){
						$(document).off('mousemove').off('mouseup');
						obj.remove();
						if(typeof(lay) !== 'undefined'){
							lay.hide();
						}
						//判断是否移动图标，如果没有则判断为click事件
						if(dx == cx && dy == cy){
							HROS.appmanage.close();
							switch(oldobj.attr('type')){
								case 'widget':
								case 'pwidget':
									HROS.widget.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
								case 'app':
								case 'papp':
								case 'folder':
									HROS.window.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
							}
							return false;
						}

						var icon, icon2;
						var iconIndex = $('#amg_folder_container .folderItem:eq(' + oldobj.attr('desk') + ') .folderInner li').length == 0 ? -1 : $('#amg_folder_container .folderItem:eq(' + oldobj.attr('desk') + ') .folderInner li').index(oldobj);
						var iconIndex2 = $('#amg_dock_container').html() == '' ? -1 : $('#amg_dock_container li').index(oldobj);
						if(cy <= 80){
							icon2 = HROS.grid.searchManageDockAppGrid(cx);
							if(icon2 != null && icon2 != oldobj.index()){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updateMyApp&movetype=dock-dock&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.index() + '&to=' + icon2 + '&desk=' + HROS.CONFIG.desk,
									success : function(){
										if(icon2 < iconIndex2){
											$('#amg_dock_container li:eq(' + icon2 + ')').before(oldobj);
										}else if(icon2 > iconIndex2){
											$('#amg_dock_container li:eq(' + icon2 + ')').after(oldobj);
										}
										HROS.appmanage.appresize();
										HROS.appmanage.getScrollbar();
									}
								});
							}
						}else{
							var movedesk = parseInt(cx / ($(document).width() / 5));
							icon = HROS.grid.searchManageAppGrid(cy - 90, movedesk);
							if(icon != null){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updateMyApp&movetype=dock-desk&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.index() + '&to=' + (icon + 1) + '&desk=' + (movedesk + 1),
									success : function(){
										if(icon < iconIndex){
											$('#amg_folder_container .folderItem:eq(' + movedesk + ') .folderInner li:eq(' + icon + ')').before(oldobj);
										}else if(icon > iconIndex){
											$('#amg_folder_container .folderItem:eq(' + movedesk + ') .folderInner li:eq(' + icon + ')').after(oldobj);
										}else{
											if(iconIndex == -1){
												$('#amg_folder_container .folderItem:eq(' + movedesk + ') .folderInner').append(oldobj);
											}
										}
										HROS.appmanage.appresize();
										HROS.appmanage.getScrollbar();
									}
								});
							}
						}
					});
				}
				return false;
			});
			$('#amg_folder_container').off('mousedown', 'li.appbtn:not(.add)').on('mousedown', 'li.appbtn:not(.add)', function(e){
				e.preventDefault();
				e.stopPropagation();
				if(e.button == 0 || e.button == 1){
					var oldobj = $(this), x, y, cx, cy, dx, dy, lay, obj = $('<li id="shortcut_shadow2">' + oldobj.html() + '</li>');
					dx = cx = e.clientX;
					dy = cy = e.clientY;
					x = dx - oldobj.offset().left;
					y = dy - oldobj.offset().top;
					//绑定鼠标移动事件
					$(document).on('mousemove', function(e){
						$('body').append(obj);
						lay = HROS.maskBox.desk();
						lay.show();
						cx = e.clientX <= 0 ? 0 : e.clientX >= $(document).width() ? $(document).width() : e.clientX;
						cy = e.clientY <= 0 ? 0 : e.clientY >= $(document).height() ? $(document).height() : e.clientY;
						_l = cx - x;
						_t = cy - y;
						if(dx != cx || dy != cy){
							obj.css({left:_l, top:_t}).show();
						}
					}).on('mouseup', function(){
						$(document).off('mousemove').off('mouseup');
						obj.remove();
						if(typeof(lay) !== 'undefined'){
							lay.hide();
						}
						//判断是否移动图标，如果没有则判断为click事件
						if(dx == cx && dy == cy){
							HROS.appmanage.close();
							switch(oldobj.attr('type')){
								case 'widget':
								case 'pwidget':
									HROS.widget.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
								case 'app':
								case 'papp':
								case 'folder':
									HROS.window.create(oldobj.attr('realid'), oldobj.attr('type'));
									break;
							}
							return false;
						}
						var icon, icon2;
						var iconIndex = $('#amg_folder_container .folderItem:eq(' + oldobj.attr('desk') + ') .folderInner li').length == 0 ? -1 : $('#amg_folder_container .folderItem:eq(' + oldobj.attr('desk') + ') .folderInner li').index(oldobj);
						var iconIndex2 = $('#amg_dock_container').html() == '' ? -1 : $('#amg_dock_container li').index(oldobj);
						if(cy <= 80){
							icon2 = HROS.grid.searchManageDockAppGrid(cx);
							if(icon2 != null){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updateMyApp&movetype=desk-dock&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.index() + '&to=' + (icon2 + 1) + '&desk=' + (parseInt(oldobj.attr('desk')) + 1),
									success : function(){
										if(icon2 < iconIndex2){
											$('#amg_dock_container li:eq(' + icon2 + ')').before(oldobj);
										}else if(icon2 > iconIndex2){
											$('#amg_dock_container li:eq(' + icon2 + ')').after(oldobj);
										}else{
											if(iconIndex2 == -1){
												$('#amg_dock_container').append(oldobj);
											}
										}
										if($('#amg_dock_container li.shortcut').length > 7){
											if($('#amg_folder_container .folderItem:eq(' + oldobj.attr('desk') + ') .folderInner li').length == 0){
												$('#amg_folder_container .folderItem:eq(' + oldobj.attr('desk') + ') .folderInner').append($('#amg_dock_container li').last());
											}else{
												$('#amg_folder_container .folderItem:eq(' + oldobj.attr('desk') + ') .folderInner li').last().after($('#amg_dock_container li').last());
											}
										}
										HROS.appmanage.appresize();
										HROS.appmanage.getScrollbar();
									}
								});
							}
						}else{
							var movedesk = parseInt(cx / ($(document).width() / 5));
							icon = HROS.grid.searchManageAppGrid(cy - 90, movedesk);
							if(icon != null){
								//判断是在同一桌面移动，还是跨桌面移动
								if(movedesk == oldobj.attr('desk')){
									$.ajax({
										type : 'POST',
										url : ajaxUrl,
										data : 'ac=updateMyApp&movetype=desk-desk&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.index() + '&to=' + icon + '&desk=' + (movedesk + 1),
										success : function(){
											if(icon < iconIndex){
												$('#amg_folder_container .folderItem:eq(' + movedesk + ') .folderInner li:eq(' + icon + ')').before(oldobj);
											}else if(icon > iconIndex){
												$('#amg_folder_container .folderItem:eq(' + movedesk + ') .folderInner li:eq(' + icon + ')').after(oldobj);
											}else{
												if(iconIndex == -1){
													$('#amg_folder_container .folderItem:eq(' + movedesk + ') .folderInner').append(oldobj);
												}
											}
											HROS.appmanage.appresize();
											HROS.appmanage.getScrollbar();
										}
									});
								}else{
									$.ajax({
										type : 'POST',
										url : ajaxUrl,
										data : 'ac=updateMyApp&movetype=desk-otherdesk&id=' + oldobj.attr('realid') + '&type=' + oldobj.attr('type') + '&from=' + oldobj.index() + '&to=' + icon + '&desk=' + (parseInt(oldobj.attr('desk')) + 1) + '&otherdesk=' + (movedesk + 1),
										success : function(){
											if(icon != -1){
												$('#amg_folder_container .folderItem:eq(' + movedesk + ') .folderInner li:eq(' + icon + ')').before(oldobj);
											}else{
												$('#amg_folder_container .folderItem:eq(' + movedesk + ') .folderInner').append(oldobj);
											}
											HROS.appmanage.appresize();
											HROS.appmanage.getScrollbar();
										}
									});
								}
							}
						}
					});
				}
				return false;
			});
		}
	}
})();

/*
**  一个不属于其他模块的模块
*/
HROS.base = (function(){
	return {
		/*
		**	系统初始化
		*/
		init : function(){
			//文件上传
			//HROS.uploadFile.init();
			//增加离开页面确认窗口，IE下有bug，暂时屏蔽
			if(!$.browser.msie){
				window.onbeforeunload = Util.confirmExit;
			}
			//绑定body点击事件，主要目的就是为了强制隐藏右键菜单
			$('#desktop').on('click', function(){
				$('.popup-menu').hide();
				$('.quick_view_container').remove();
			});
			//隐藏浏览器默认右键菜单
			$('body').on('contextmenu', function(){
				$(".popup-menu").hide();
				return false;
			});
			//绑定浏览器resize事件
			HROS.base.resize();
			//用于判断网页是否缩放，该功能提取自QQ空间
			HROS.zoom.init();
			//加载壁纸
			HROS.wallpaper.get(function(){
				HROS.wallpaper.set();
			});
			//初始化分页栏
			HROS.navbar.init();
			//绑定任务栏点击事件
			HROS.taskbar.init();
			//获得dock的位置
			HROS.dock.getPos(function(){
				//获取图标排列顺序
				HROS.app.getXY(function(){
					/*
					**      当dockPos为top时          当dockPos为left时         当dockPos为right时
					**  -----------------------   -----------------------   -----------------------
					**  | o o o         dock  |   | o | o               |   | o               | o |
					**  -----------------------   | o | o               |   | o               | o |
					**  | o o                 |   | o | o               |   | o               | o |
					**  | o +                 |   |   | o               |   | o               |   |
					**  | o             desk  |   |   | o         desk  |   | o         desk  |   |
					**  | o                   |   |   | +               |   | +               |   |
					**  -----------------------   -----------------------   -----------------------
					**  因为desk区域的尺寸和定位受dock位置的影响，所以加载图标前必须先定位好dock的位置
					*/
					HROS.app.get();
				});
			});
			//绑定应用码头2个按钮的点击事件
			$('.dock-tool-pinyin').on('mousedown', function(){
				return false;
			}).on('click',function(){
				javascript:(function(q){q?q.toggle():function(d,j){j=d.createElement('script');j.async=true;j.src='//ime.qq.com/fcgi-bin/getjs';j.setAttribute('ime-cfg','lt=2');d=d.getElementsByTagName('head')[0];d.insertBefore(j,d.firstChild)}(document)})(window.QQWebIME);
			});
			$('.dock-tool-style').on('mousedown', function(){
				return false;
			}).on('click', function(){
				HROS.window.createTemp({
					id : 'ztsz',
					title : '主题设置',
					url : 'sysapp/wallpaper/index.php',
					width : 580,
					height : 520,
					isresize : false,
					isflash : false
				});
			});
			//桌面右键
			$('#desk').on('contextmenu', function(e){
				$(".popup-menu").hide();
				$('.quick_view_container').remove();
				var popupmenu = HROS.popupMenu.desk();
				l = ($(document).width() - e.clientX) < popupmenu.width() ? (e.clientX - popupmenu.width()) : e.clientX;
				t = ($(document).height() - e.clientY) < popupmenu.height() ? (e.clientY - popupmenu.height()) : e.clientY;
				popupmenu.css({
					left : l,
					top : t
				}).show();
				return false;
			});
			//还原widget
			HROS.widget.reduction();
			//加载新手帮助
			HROS.base.help();
			//配置artDialog全局默认参数
			(function(config){
				config['lock'] = true;
				config['fixed'] = true;
				config['resize'] = false;
				config['background'] = '#000';
				config['opacity'] = 0.5;
			})($.dialog.defaults);
		},
		logout : function(){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=logout',
				success : function(){
					location.href = 'login.php';
				}
			});
		},
		resize : function(){
			$(window).on('resize', function(){
				HROS.deskTop.resize(200);
			});
		},
		getSkin : function(){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=getSkin',
				success : function(skin){
					$('#window-skin').remove();
					var link = document.createElement('link');
					link.rel = 'stylesheet';
					link.href = 'img/skins/' + skin + '.css?' + version;
					link.id = 'window-skin';
					$('body').append(link);
				}
			});
		},
		help : function(){
			if($.cookie('isLoginFirst') == null){
				$.cookie('isLoginFirst', '1', {expires : 95});
				if(!$.browser.msie || ($.browser.msie && $.browser.version < 9)){
					$('body').append(helpTemp);
					//IE6,7,8基本就告别新手帮助了
					$('#step1').show();
					$('.close').on('click', function(){
						$('#help').remove();
					});
					$('.next').on('click', function(){
						var obj = $(this).parents('.step');
						var step = obj.attr('step');
						obj.hide();
						$('#step' + (parseInt(step) + 1)).show();
					});
					$('.over').on('click', function(){
						$('#help').remove();
					});
				}
			}
		}
	}
})();

/*
**  桌面
*/
HROS.deskTop = (function(){
	return {
		/*
		**  处理浏览器改变大小后的事件
		*/
		resize : function(time){
			//使用doTimeout插件，防止出现resize两次的bug
			$.doTimeout('resize', time, function(){
				console.log(1);
				if($('#desktop').css('display') !== 'none'){
					//更新码头位置
					HROS.dock.setPos();
					//更新图标定位
					HROS.deskTop.appresize();
					//更新窗口定位
					HROS.deskTop.windowresize();
					//更新滚动条
					HROS.app.getScrollbar();
				}else{
					HROS.appmanage.resize();
				}
				HROS.wallpaper.set(false);
			});
		},
		/*
		**  重新排列图标
		*/
		appresize : function(){
			var grid = HROS.grid.getAppGrid(), dockGrid = HROS.grid.getDockAppGrid();
			$('#dock-bar .dock-applist li').each(function(i){
				$(this).animate({
					'left' : dockGrid[i]['startX'],
					'top' : dockGrid[i]['startY']
				}, 500);
			});
			for(var j = 1; j <= 5; j++){
				$('#desk-' + j + ' li').each(function(i){
					$(this).animate({
						'left' : grid[i]['startX'] + 16,
						'top' : grid[i]['startY'] + 7
					}, 500);
				});
			}
		},
		/*
		**  重新定位窗口位置
		*/
		windowresize : function(){
			$('#desk div.window-container').each(function(){
				var windowdata = $(this).data('info');
				currentW = $(window).width() - $(this).width();
				currentH = $(window).height() - $(this).height();
				_l = windowdata['left'] / windowdata['emptyW'] * currentW >= currentW ? currentW : windowdata['left'] / windowdata['emptyW'] * currentW;
				_l = _l <= 0 ? 0 : _l;
				_t = windowdata['top'] / windowdata['emptyH'] * currentH >= currentH ? currentH : windowdata['top'] / windowdata['emptyH'] * currentH;
				_t = _t <= 0 ? 0 : _t;
				$(this).animate({
					'left' : _l,
					'top' : _t
				}, 500);
			});
		}
	}
})();

/*
**  应用码头
*/
HROS.dock = (function(){
	return {
		getPos : function(fun){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=getDockPos',
				success : function(i){
					HROS.CONFIG.dockPos = i;
					HROS.dock.setPos();
					if(typeof(fun) != 'undefined'){
						fun();
					}
				}
			});
		},
		setPos : function(){
			var desktop = $('#desk-' + HROS.CONFIG.desk), desktops = $('#desk .desktop-container');
			var desk_w = desktop.css('width', '100%').width(), desk_h = desktop.css('height', '100%').height();
			//清除dock位置样式
			$('#dock-container').removeClass('dock-top').removeClass('dock-left').removeClass('dock-right');
			$('#dock-bar').removeClass('top-bar').removeClass('left-bar').removeClass('right-bar').hide();
			if(HROS.CONFIG.dockPos == 'top'){
				$('#dock-bar').addClass('top-bar').children('#dock-container').addClass('dock-top');
				desktops.css({
					'width' : desk_w,
					'height' : desk_h - 143,
					'left' : desk_w,
					'top' : 73
				});
				desktop.css({
					'left' : 0
				});
			}else if(HROS.CONFIG.dockPos == 'left'){
				$('#dock-bar').addClass('left-bar').children('#dock-container').addClass('dock-left');
				desktops.css({
					'width' : desk_w - 73,
					'height' : desk_h - 70,
					'left' : desk_w + 73,
					'top' : 0
				});
				desktop.css({
					'left' : 73
				});
			}else if(HROS.CONFIG.dockPos == 'right'){
				$('#dock-bar').addClass('right-bar').children('#dock-container').addClass('dock-right');
				desktops.css({
					'width' : desk_w - 73,
					'height' : desk_h - 70,
					'left' : desk_w,
					'top' : 0
				});
				desktop.css({
					'left' : 0
				});
			}
			$('#dock-bar').show();
			HROS.taskbar.resize();
		},
		updatePos : function(pos, fun){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=setDockPos&dock=' + pos,
				success : function(){
					HROS.CONFIG.dockPos = pos;
					if(typeof(fun) != 'undefined'){
						fun();
					}
				}
			});
		},
		move : function(){
			$('#dock-container').off('mousedown').on('mousedown',function(e){
				if(e.button == 0 || e.button == 1){
					var lay = HROS.maskBox.dock(), location;
					$(document).on('mousemove', function(e){
						lay.show();
						if(e.clientY < lay.height() * 0.2){
							location = 'top';		
						}else if(e.clientX < lay.width() * 0.5){
							location = 'left';
						}else{				
							location = 'right';
						}
						$('.dock_drap_effect').removeClass('hover');
						$('.dock_drap_effect_' + location).addClass('hover');
					}).on('mouseup', function(){
						$(document).off('mousemove').off('mouseup');
						lay.hide();
						if(location != HROS.CONFIG.dockPos && typeof(location) != 'undefined'){
							HROS.dock.updatePos(location, function(){
								//更新码头位置
								HROS.dock.setPos();
								//更新图标位置
								HROS.deskTop.appresize();
								//更新滚动条
								HROS.app.getScrollbar();
							});
						}
					});
				}
			});
		}
	}
})();

HROS.folderView = (function(){
	return {
		init : function(obj){
			var folderViewHtml = '';
			$.getJSON(ajaxUrl + '?ac=getMyFolderApp&folderid=' + obj.attr('realid'), function(sc){
				var height = 0;
				if(sc != null){
					for(var i = 0; i < sc.length; i++){
						switch(sc[i]['type']){
							case 'app':
							case 'widget':
							case 'papp':
							case 'pwidget':
								folderViewHtml += appbtnTemp({
									'top' : 0,
									'left' : 0,
									'title' : sc[i]['name'],
									'type' : sc[i]['type'],
									'id' : 'd_' + sc[i]['type'] + '_' + sc[i]['id'],
									'realid' : sc[i]['id'],
									'imgsrc' : sc[i]['icon']
								});
								break;
						}
					}
					if(sc.length % 4 == 0){
						height += Math.floor(sc.length / 4) * 60;
					}else{
						height += (Math.floor(sc.length / 4) + 1) * 60;
					}
				}else{
					folderViewHtml = '文件夹为空';
					height += 30;
				}
				//判断是桌面上的文件夹，还是应用码头上的文件夹
				var left, top;
				if(obj.parent('div').hasClass('dock-applist')){
					left = obj.offset().left + 60;
					top = obj.offset().top;
				}else{
					left = obj.offset().left + 80;
					top = obj.offset().top - 20;
				}
				//判断预览面板是否有超出屏幕
				var isScrollbar = false;
				if(height + top + 46 > $(document).height()){
					var outH = height + top + 46 - $(document).height();
					if(outH <= top){
						top -= outH;
					}else{
						height -= outH - top;
						top = 0;
						isScrollbar = true;
					}
				}
				$('.quick_view_container').remove();
				if(left + 340 > $(document).width()){
					//预览居左
					$('body').append(folderViewTemp({
						'id' : 'qv_' + obj.attr('realid'),
						'realid' : obj.attr('realid'),
						'apps' : folderViewHtml,
						'top' : top,
						'left' : left - 340 - 80,
						'height' : height,
						'mlt' : Math.ceil((height + 26) / 2),
						'mlm' : false,
						'mlb' : Math.ceil((height + 26) / 2),
						'mrt' : obj.offset().top - top,
						'mrm' : true,
						'mrb' : height + 26 - (obj.offset().top - top) - 20
					}));
				}else{
					//预览居右
					$('body').append(folderViewTemp({
						'id' : 'qv_' + obj.attr('realid'),
						'realid' : obj.attr('realid'),
						'apps' : folderViewHtml,
						'top' : top,
						'left' : left,
						'height' : height,
						'mlt' : obj.offset().top - top,
						'mlm' : true,
						'mlb' : height + 26 - (obj.offset().top - top) - 20,
						'mrt' : Math.ceil((height + 26) / 2),
						'mrm' : false,
						'mrb' : Math.ceil((height + 26) / 2)
					}));
				}
				$('body').on('contextmenu', '.appbtn:not(.add)', function(e){
					$('.popup-menu').hide();
					TEMP.AppRight = HROS.popupMenu.app($(this));
					var l = ($(document).width() - e.clientX) < TEMP.AppRight.width() ? (e.clientX - TEMP.AppRight.width()) : e.clientX;
					var t = ($(document).height() - e.clientY) < TEMP.AppRight.height() ? (e.clientY - TEMP.AppRight.height()) : e.clientY;
					TEMP.AppRight.css({
						left : l,
						top : t
					}).show();
					return false;
				});
				$('.quick_view_container_open').on('click',function(){
					HROS.window.create($(this).parents('.quick_view_container').attr('realid'), 'folder');
					$('#quick_view_container_' + $(this).parents('.quick_view_container').attr('realid')).remove();
				});
				HROS.folderView.getScrollbar(obj.attr('realid'),isScrollbar);
				HROS.folderView.moveScrollbar(obj.attr('realid'));
				HROS.app.move();
			});
		},
		getScrollbar : function(id, isScrollbar){
			var view = '#quick_view_container_list_in_' + id;
			var scrollbar = '#quick_view_container_list_' + id + ' .scrollBar';
			if(isScrollbar){
				$('#quick_view_container_list_' + id + ' .scrollBar_bgc').show();
				$(scrollbar).show().height($(view).height() / (Math.ceil($(view).children().length / 4) * 60) * $(view).height());
			}else{
				$('#quick_view_container_list_' + id + ' .scrollBar_bgc').hide();
				$(scrollbar).hide().height(0);
			}
		},
		moveScrollbar : function(id){
			var view = '#quick_view_container_list_in_' + id;
			var scrollbar = '#quick_view_container_list_' + id + ' .scrollBar';
			/*
			**  手动拖动
			*/
			$(scrollbar).on('mousedown', function(e){
				var offsetTop = $('#quick_view_container_' + id).offset().top + 36;
				var y, cy, deskrealh, moveh;
				var scrollbar = $(this), desk = $(view);
				deskrealh = Math.ceil($(view).children().length / 4) * 60;
				moveh = desk.height() - scrollbar.height();
				y = e.clientY - scrollbar.offset().top;
				$(document).on('mousemove', function(e){
					cy = e.clientY - y - offsetTop < 0 ? 0 : e.clientY - y - offsetTop > moveh ? moveh : e.clientY - y - offsetTop;
					scrollbar.css('top', cy);
					desk.scrollTop(cy / desk.height() * deskrealh);
				}).on('mouseup', function(){
					$(this).off('mousemove').off('mouseup');
				});
			});
			/*
			**  鼠标滚轮
			*/
			$(view).off('mousewheel').on('mousewheel', function(event, delta){
				var desk = $(this), deskrealh = Math.ceil($(view).children().length / 4) * 60, scrollupdown;
				/*
				**  delta == -1   往下
				**  delta == 1    往上
				*/
				if(delta < 0){
					scrollupdown = desk.scrollTop() + 40 > deskrealh - desk.height() ? deskrealh - desk.height() : desk.scrollTop() + 40;
				}else{
					scrollupdown = desk.scrollTop() - 40 < 0 ? 0 : desk.scrollTop() - 40;
				}
				desk.stop(false, true).animate({
					scrollTop : scrollupdown
				}, 300);
				$(scrollbar).stop(false, true).animate({
					top : scrollupdown / deskrealh * desk.height()
				}, 300);
			});
		}
	}
})();

/*
**  图标布局格子
**  这篇文章里有简单说明格子的作用
**  http://www.cnblogs.com/hooray/archive/2012/03/23/2414410.html
*/
HROS.grid = (function(){
	return {
		getAppGrid : function(){
			var width, height;
			width = $('#desk-' + HROS.CONFIG.desk).width() - HROS.CONFIG.appButtonLeft;
			height = $('#desk-' + HROS.CONFIG.desk).height() - HROS.CONFIG.appButtonTop;
			var appGrid = [], _top = HROS.CONFIG.appButtonTop, _left = HROS.CONFIG.appButtonLeft;
			for(var i = 0; i < 10000; i++){
				appGrid.push({
					startY : _top,
					endY : _top + 100,
					startX : _left,
					endX : _left + 120
				});
				if(HROS.CONFIG.appXY == 'x'){
					_left += 120;
					if(_left + 100 > width){
						_top += 100;
						_left = HROS.CONFIG.appButtonLeft;
					}
				}else{
					_top += 100;
					if(_top + 70 > height){
						_top = HROS.CONFIG.appButtonTop;
						_left += 120;
					}
				}
			}
			return appGrid;
		},
		searchAppGrid : function(x, y){
			var grid = HROS.grid.getAppGrid(), j = grid.length;
			var flags = 0, appLength = $('#desk-' + HROS.CONFIG.desk + ' li.appbtn:not(.add)').length - 1;
			for(var i = 0; i < j; i++){
				if(x >= grid[i].startX && x <= grid[i].endX){
					flags += 1;
				}
				if(y >= grid[i].startY && y <= grid[i].endY){
					flags += 1;
				}
				if(flags === 2){
					return i > appLength ? appLength : i;
				}else{
					flags = 0;
				}
			}
			return null;
		},
		getDockAppGrid : function(){
			var height = $('#dock-bar .dock-applist').height();
			var dockAppGrid = [], _left = 0, _top = 0;
			for(var i = 0; i < 7; i++){
				dockAppGrid.push({
					startY : _top,
					endY : _top + 62,
					startX : _left,
					endX : _left + 62
				});
				_top += 62;
				if(_top + 62 > height){
					_top = 0;
					_left += 62;
				}
			}
			return dockAppGrid;
		},
		searchDockAppGrid : function(x, y){
			var grid = HROS.grid.getDockAppGrid(), j = grid.length, flags = 0,
				appLength = $('#dock-bar .dock-applist li').length - 1;
			for(var i = 0; i < j; i++){
				if(x >= grid[i].startX && x <= grid[i].endX){
					flags += 1;
				}
				if(y >= grid[i].startY && y <= grid[i].endY){
					flags += 1;
				}
				if(flags === 2){
					return i > appLength ? appLength : i;
				}else{
					flags = 0;
				}
			}
			return null;
		},
		getFolderGrid : function(){
			var folderGrid = [];
			$('.folder-window:visible').each(function(){
				folderGrid.push({
					zIndex : $(this).css('z-index'),
					id : $(this).attr('realid'),
					startY : $(this).offset().top,
					endY : $(this).offset().top + $(this).height(),
					startX :  $(this).offset().left,
					endX :  $(this).offset().left +  $(this).width()
				});
			});
			folderGrid.sort(function(x, y){
				return y['zIndex'] - x['zIndex'];
			});
			return folderGrid;
		},
		searchFolderGrid : function(x, y){
			var folderGrid = HROS.grid.getFolderGrid(), j = folderGrid.length, flags = 0;
			for(var i = 0; i < j; i++){
				if(x >= folderGrid[i].startX && x <= folderGrid[i].endX){
					flags += 1;
				}
				if(y >= folderGrid[i].startY && y <= folderGrid[i].endY){
					flags += 1;
				}
				if(flags === 2){
					return folderGrid[i]['id'];
				}else{
					flags = 0;
				}
			}
			return null;
		},
		getManageDockAppGrid : function(){
			var manageDockAppGrid = [], _left = 20;
			for(var i = 0; i < 7; i++){
				manageDockAppGrid.push({
					startX : _left,
					endX : _left + 72
				});
				_left += 72;
			}
			return manageDockAppGrid;
		},
		searchManageDockAppGrid : function(x){
			var grid = HROS.grid.getManageDockAppGrid(), j = grid.length, flags = 0,
				appLength = $('#amg_dock_container li').length - 1;
			for(var i = 0; i < j; i++){
				if(x >= grid[i].startX && x <= grid[i].endX){
					flags += 1;
				}
				if(flags === 1){
					return i > appLength ? appLength : i;
				}else{
					flags = 0;
				}
			}
			return null;
		},
		getManageAppGrid : function(){
			var manageAppGrid = [], _top = 0;
			for(var i = 0; i < 10000; i++){
				manageAppGrid.push({
					startY : _top,
					endY : _top + 40
				});
				_top += 40;
			}
			return manageAppGrid;
		},
		searchManageAppGrid : function(y, desk){
			var grid = HROS.grid.getManageAppGrid(), j = grid.length, flags = 0,
				appLength = $('#amg_folder_container .folderItem:eq('+desk+') .folderInner li').length - 1;
			for(var i = 0; i < j; i++){
				if(y >= grid[i].startY && y <= grid[i].endY){
					flags += 1;
				}
				if(flags === 1){
					return i > appLength ? appLength : i;
				}else{
					flags = 0;
				}
			}
			return null;
		}
	}
})();

/*
**  透明遮罩层
**  当拖动图标、窗口等一切可拖动的对象时，会加载一个遮罩层
**  避免拖动时触发或选中一些不必要的操作，安全第一
*/
HROS.maskBox = (function(){
	return {
		desk : function(){
			if(!TEMP.maskBoxDesk){
				TEMP.maskBoxDesk = $('<div id="maskbox"></div>');
				$('body').append(TEMP.maskBoxDesk);
			}
			return TEMP.maskBoxDesk;
		},
		dock : function(){
			if(!TEMP.maskBoxDock){
				TEMP.maskBoxDock = $('<div style="z-index:1000000003;display:block;cursor:default;background:none;width:100%;height:100%;position:absolute;top:0;left:0"><div id="docktop" class="dock_drap_effect dock_drap_effect_top"></div><div id="dockleft" class="dock_drap_effect dock_drap_effect_left"></div><div id="dockright" class="dock_drap_effect dock_drap_effect_right"></div><div id="dockmask" class="dock_drap_mask"><div class="dock_drop_region_top"></div><div class="dock_drop_region_left"></div><div class="dock_drop_region_right"></div></div></div>');
				$('body').append(TEMP.maskBoxDock);
			}
			return TEMP.maskBoxDock;
		}
	}
})();

/*
**  分页导航
*/
HROS.navbar = (function(){
	return {
		/*
		**  初始化
		*/
		init : function(){
			$('#nav-bar').css({
				'left' : $(document).width() / 2 - 105,
				'top' : 80
			}).show();
			HROS.navbar.move();
			HROS.navbar.deskSwitch();
		},
		/*
		**  拖动
		*/
		move : function(){
			$('#nav-bar').on('mousedown', function(e){
				if(e.button == 0 || e.button == 1){
					var x, y, cx, cy, lay, obj = $('#nav-bar');
					x = e.clientX - obj.offset().left;
					y = e.clientY - obj.offset().top;
					//绑定鼠标移动事件
					$(document).on('mousemove', function(e){
						lay = HROS.maskBox.desk();
						lay.show();
						cx = e.clientX - x <= 0 ? 0 : e.clientX - x > $(document).width() - 210 ? $(document).width() - 210 : e.clientX - x;
						cy = e.clientY - y <= 10 ? 10 : e.clientY - y > $(document).height() - 50 ? $(document).height() - 50 : e.clientY - y;
						obj.css({
							left : cx,
							top : cy
						});
					}).on('mouseup', function(){
						if(typeof(lay) !== 'undefined'){
							lay.hide();
						}
						$(this).off('mousemove').off('mouseup');
					});
				}
			});
		},
		/*
		**  点击切换
		*/
		deskSwitch : function(){
			$('#nav-bar .nav-container').on('mousedown', 'a.indicator', function(e){
				$('.popup-menu').hide();
				$('.quick_view_container').remove();
				if(e.button == 0 || e.button == 1){
					var x, y, cx, cy, dx, dy, lay, obj = $('#nav-bar'), thisobj = $(this);
					dx = cx = obj.offset().left;
					dy = cy = obj.offset().top;
					x = e.clientX - dx;
					y = e.clientY - dy;
					//绑定鼠标移动事件
					$(document).on('mousemove', function(e){
						lay = HROS.maskBox.desk();
						lay.show();
						cx = e.clientX - x <= 0 ? 0 : e.clientX - x > $(document).width() - 210 ? $(document).width() - 210 : e.clientX - x;
						cy = e.clientY - y <= 10 ? 10 : e.clientY - y > $(document).height() - 50 ? $(document).height() - 50 : e.clientY - y;
						obj.css({
							left : cx,
							top : cy
						});
					}).on('mouseup', function(){
						if(dx == cx && dy == cy){
							if(typeof(thisobj.attr('index')) !== 'undefined'){
								var nav = $('#navContainer'), currindex = HROS.CONFIG.desk, switchindex = thisobj.attr('index'),
								currleft = $('#desk-' + currindex).offset().left, switchleft = $('#desk-' + switchindex).offset().left;
								if(currindex != switchindex){
									if(!$('#desk-' + switchindex).hasClass('animated') && !$('#desk-' + currindex).hasClass('animated')){
										$('#desk-' + currindex).addClass('animated').animate({
											left : switchleft
										}, 500, 'easeInOutCirc', function(){
											$(this).removeClass('animated');
										});
										$('#desk-'+switchindex).addClass('animated').animate({
											left : currleft
										}, 500, 'easeInOutCirc', function(){
											$(this).removeClass('animated');
											nav.removeClass('nav-current-' + currindex).addClass('nav-current-' + switchindex);
											HROS.CONFIG.desk = switchindex;
										});
									}
								}
							}else{
								//初始化全局视图
								HROS.appmanage.init();
							}
						}
						if(typeof(lay) !== 'undefined'){
							lay.hide();
						}
						$(this).off('mousemove').off('mouseup');
					});
				}
			});
		}
	}
})();

/*
**  右键菜单
*/
HROS.popupMenu = (function(){
	return {
		/*
		**  应用图标右键
		*/
		app : function(obj){
			if(!TEMP.popupMenuApp){
				TEMP.popupMenuApp = $('<div class="popup-menu app-menu" style="z-index:9990;display:none"><ul><li style="border-bottom:1px solid #F0F0F0"><a menu="open" href="javascript:;">打开应用</a></li><li><a menu="move" href="javascript:;">移动应用到<b class="arrow">»</b></a><div class="popup-menu" style="display:none"><ul><li><a menu="moveto" desk="1" href="javascript:;">桌面1</a></li><li><a menu="moveto" desk="2" href="javascript:;">桌面2</a></li><li><a menu="moveto" desk="3" href="javascript:;">桌面3</a></li><li><a menu="moveto" desk="4" href="javascript:;">桌面4</a></li><li><a menu="moveto" desk="5" href="javascript:;">桌面5</a></li></ul></div></li><li><b class="uninstall"></b><a menu="del" href="javascript:;">卸载应用</a></li></ul></div>');
				$('body').append(TEMP.popupMenuApp);
				$('.app-menu').on('contextmenu', function(){
					return false;
				});
			}
			$('.app-menu a[menu="moveto"]').removeClass('disabled');
			if(obj.parent().hasClass('desktop-container')){
				$('.app-menu a[menu="moveto"]').each(function(){
					if($(this).attr('desk') == HROS.CONFIG.desk){
						$(this).addClass('disabled');
					}
				});
			}
			//绑定事件
			$('.app-menu li').off('mouseover').off('mouseout').on('mouseover', function(){
				if($(this).children('a').attr('menu') == 'move'){
					$(this).children('a').addClass('focus');
					if($(document).width() - $('.app-menu').offset().left > 250){
						$(this).children('div').css({
							left : 122,
							top : -2
						});
					}else{
						$(this).children('div').css({
							left : -126,
							top : -2
						});
					}
					$(this).children('div').show();
				}
			}).on('mouseout', function(){
				$(this).children('a').removeClass('focus');
				$(this).children('div').hide();
			});
			$('.app-menu a[menu="moveto"]').off('click').on('click', function(){
				var desk = $(this).attr('desk');
				$.ajax({
					type : 'POST',
					url : ajaxUrl,
					data : 'ac=moveMyApp&id=' + obj.attr('realid') + '&type=' + obj.attr('type') + '&todesk=' + desk,
					success : function(){
						$('#desk-' + desk + ' li.add').before(obj);
						HROS.deskTop.appresize();
						HROS.app.getScrollbar();
					}
				});
				$('.popup-menu').hide();
			});
			$('.app-menu a[menu="open"]').off('click').on('click', function(){
				HROS.window.create(obj.attr('realid'), obj.attr('type'));
				$('.task-menu').hide();
			});
			$('.app-menu a[menu="del"]').off('click').on('click', function(){
				HROS.app.remove(obj.attr('realid'), obj.attr('type'), function(){
					obj.find('img, span').show().animate({
						opacity : 'toggle',
						width : 0,
						height : 0
					}, 500, function(){
						obj.remove();
						HROS.deskTop.resize(250);
					});
				});
				$('.popup-menu').hide();
			});
			return TEMP.popupMenuApp;
		},
		papp : function(obj){
			if(!TEMP.popupMenuApp){
				TEMP.popupMenuApp = $('<div class="popup-menu papp-menu" style="z-index:9990;display:none"><ul><li style="border-bottom:1px solid #F0F0F0"><a menu="open" href="javascript:;">打开应用</a></li><li><a menu="move" href="javascript:;">移动应用到<b class="arrow">»</b></a><div class="popup-menu" style="display:none"><ul><li><a menu="moveto" desk="1" href="javascript:;">桌面1</a></li><li><a menu="moveto" desk="2" href="javascript:;">桌面2</a></li><li><a menu="moveto" desk="3" href="javascript:;">桌面3</a></li><li><a menu="moveto" desk="4" href="javascript:;">桌面4</a></li><li><a menu="moveto" desk="5" href="javascript:;">桌面5</a></li></ul></div></li><li><b class="edit"></b><a menu="edit" href="javascript:;">编辑</a></li><li><b class="del"></b><a menu="del" href="javascript:;">删除应用</a></li></ul></div>');
				$('body').append(TEMP.popupMenuApp);
				$('.papp-menu').on('contextmenu', function(){
					return false;
				});
			}
			$('.papp-menu a[menu="moveto"]').removeClass('disabled');
			if(obj.parent().hasClass('desktop-container')){
				$('.papp-menu a[menu="moveto"]').each(function(){
					if($(this).attr('desk') == HROS.CONFIG.desk){
						$(this).addClass('disabled');
					}
				});
			}
			//绑定事件
			$('.papp-menu li').off('mouseover').off('mouseout').on('mouseover', function(){
				if($(this).children('a').attr('menu') == 'move'){
					$(this).children('a').addClass('focus');
					if($(document).width() - $('.papp-menu').offset().left > 250){
						$(this).children('div').css({
							left : 122,
							top : -2
						});
					}else{
						$(this).children('div').css({
							left : -126,
							top : -2
						});
					}
					$(this).children('div').show();
				}
			}).on('mouseout', function(){
				$(this).children('a').removeClass('focus');
				$(this).children('div').hide();
			});
			$('.papp-menu a[menu="moveto"]').off('click').on('click', function(){
				var desk = $(this).attr('desk');
				$.ajax({
					type : 'POST',
					url : ajaxUrl,
					data : 'ac=moveMyApp&id=' + obj.attr('realid') + '&type=' + obj.attr('type') + '&todesk=' + desk,
					success : function(){
						$('#desk-' + desk + ' li.add').before(obj);
						HROS.deskTop.appresize();
						HROS.app.getScrollbar();
					}
				});
				$('.popup-menu').hide();
			});
			$('.papp-menu a[menu="open"]').off('click').on('click', function(){
				switch(obj.attr('type')){
					case 'papp':
						HROS.window.create(obj.attr('realid'), obj.attr('type'));
						break;
					case 'pwidget':
						HROS.widget.create(obj.attr('realid'), obj.attr('type'));
						break;
				}
				$('.popup-menu').hide();
			});
			$('.papp-menu a[menu="edit"]').off('click').on('click', function(){
				function nextDo(options){
					$.dialog({
						id : 'addfolder',
						title : '编辑私人应用“' + options.title + '”',
						padding : 0,
						content : editPappDialogTemp({
							'id' : options.id,
							'name' : options.title,
							'url' : options.url,
							'width' : options.width,
							'height' : options.height
						}),
						ok : function(){
							var name = $('#addpappName').val(),
								url = $('#addpappUrl').val(),
								width = $('#addpappWidth').val(),
								height = $('#addpappHeight').val();
							if(name != '' && url != '' && width != '' && height != ''){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=updatePapp&name=' + name + '&url=' + url + '&width=' + width + '&height=' + height + '&id=' + options.id,
									success : function(pappid){
										HROS.app.get();
									}
								});
							}else{
								alert('信息填写不完整');
							}
						},
						cancel : true
					});
				}
				ZENG.msgbox.show('数据读取中，请耐心等待...', 6, 100000);
				$.getJSON(ajaxUrl + '?ac=getMyAppById&id=' + obj.attr('realid') + '&type=' + obj.attr('type'), function(app){
					if(app != null){
						ZENG.msgbox._hide();
						switch(app['type']){
							case 'papp':
							case 'pwidget':
								nextDo({
									id : app['id'],
									title : app['name'],
									url : app['url'],
									width : app['width'],
									height : app['height'],
								});
								break;
						}
					}else{
						ZENG.msgbox.show('数据拉取失败', 5, 2000);
						return false;
					}
				});
				$('.popup-menu').hide();
			});
			$('.papp-menu a[menu="del"]').off('click').on('click', function(){
				HROS.app.remove(obj.attr('realid'), obj.attr('type'), function(){
					obj.find('img, span').show().animate({
						opacity : 'toggle',
						width : 0,
						height : 0
					}, 500, function(){
						obj.remove();
						HROS.deskTop.resize(250);
					});
				});
				$('.popup-menu').hide();
			});
			return TEMP.popupMenuApp;
		},
		/*
		**  文件夹右键
		*/
		folder : function(obj){
			if(!TEMP.popupMenuFolder){
				TEMP.popupMenuFolder = $('<div class="popup-menu folder-menu" style="z-index:9990;display:none"><ul><li><a menu="view" href="javascript:;">预览</a></li><li style="border-bottom:1px solid #F0F0F0"><a menu="open" href="javascript:;">打开</a></li><li><b class="edit"></b><a menu="rename" href="javascript:;">重命名</a></li><li><b class="del"></b><a menu="del" href="javascript:;">删除</a></li></ul></div>');
				$('body').append(TEMP.popupMenuFolder);
				$('.folder-menu').on('contextmenu', function(){
					return false;
				});
			}
			//绑定事件
			$('.folder-menu a[menu="view"]').off('click').on('click', function(){
				HROS.folderView.init(obj);
				$('.popup-menu').hide();
			});
			$('.folder-menu a[menu="open"]').off('click').on('click', function(){
				HROS.window.create(obj.attr('realid'), obj.attr('type'));
				$('.popup-menu').hide();
			});
			$('.folder-menu a[menu="del"]').off('click').on('click', function(){
				$.dialog({
					id : 'delfolder',
					title : '删除“' + obj.find('span').text() + '”文件夹',
					content : '删除文件夹的同时会删除文件夹内所有应用',
					icon : 'warning',
					ok : function(){
						HROS.app.remove(obj.attr('realid'), obj.attr('type'), function(){
							obj.find('img, span').show().animate({
								opacity : 'toggle',
								width : 0,
								height : 0
							}, 500, function(){
								obj.remove();
								HROS.deskTop.resize(250);
							});
						});
					},
					cancel : true
				});
				$('.popup-menu').hide();
			});
			$('.folder-menu a[menu="rename"]').off('click').on('click', function(){
				$.dialog({
					id : 'addfolder',
					title : '重命名“' + obj.find('span').text() + '”文件夹',
					padding : 0,
					content : editFolderDialogTemp({
						'name' : obj.find('span').text(),
						'src' : obj.find('img').attr('src')
					}),
					ok : function(){
						if($('#folderName').val() != ''){
							$.ajax({
								type : 'POST',
								url : ajaxUrl,
								data : 'ac=updateFolder&name=' + $('#folderName').val() + '&icon=' + $('.folderSelector img').attr('src') + '&id=' + obj.attr('realid'),
								success : function(){
									HROS.app.get();
								}
							});
						}else{
							$('.folderNameError').show();
							return false;
						}
					},
					cancel : true
				});
				$('.folderSelector').off('click').on('click', function(){
					$('.fcDropdown').show();
				});
				$('.fcDropdown_item').off('click').on('click', function(){
					$('.folderSelector img').attr('src', $(this).children('img').attr('src')).attr('idx', $(this).children('img').attr('idx'));
					$('.fcDropdown').hide();
				});
				$('.popup-menu').hide();
			});
			return TEMP.popupMenuFolder;
		},
		/*
		**  任务栏右键
		*/
		task : function(obj){
			if(!TEMP.popupMenuTask){
				TEMP.popupMenuTask = $('<div class="popup-menu task-menu" style="z-index:9990;display:none"><ul><li><a menu="max" href="javascript:;">最大化</a></li><li style="border-bottom:1px solid #F0F0F0"><a menu="hide" href="javascript:;">最小化</a></li><li><a menu="close" href="javascript:;">关闭</a></li></ul></div>');
				$('body').append(TEMP.popupMenuTask);
				$('.task-menu').on('contextmenu', function(){
					return false;
				});
			}
			//绑定事件
			$('.task-menu a[menu="max"]').off('click').on('click', function(){
				HROS.window.max(obj.attr('realid'), obj.attr('type'));
				$('.popup-menu').hide();
			});
			$('.task-menu a[menu="hide"]').off('click').on('click', function(){
				HROS.window.hide(obj.attr('realid'), obj.attr('type'));
				$('.popup-menu').hide();
			});
			$('.task-menu a[menu="close"]').off('click').on('click', function(){
				HROS.window.close(obj.attr('realid'), obj.attr('type'));
				$('.popup-menu').hide();
			});
			return TEMP.popupMenuTask;
		},
		/*
		**  桌面右键
		*/
		desk : function(){
			if(!TEMP.popupMenuDesk){
				TEMP.popupMenuDesk = $('<div class="popup-menu desk-menu" style="z-index:9990;display:none"><ul><li><a menu="hideall" href="javascript:;">显示桌面</a></li><li><b class="refresh"></b><a menu="refresh" href="javascript:;">刷新</a></li><li style="border-bottom:1px solid #F0F0F0"><a menu="closeall" href="javascript:;">关闭所有应用</a></li><li><a href="javascript:;">新建<b class="arrow">»</b></a><div class="popup-menu" style="display:none"><ul><li><b class="folder"></b><a menu="addfolder" href="javascript:;">新建文件夹</a></li><li><b class="customapp"></b><a menu="addpapp" href="javascript:;">新建私人应用</a></li></ul></div></li><!--li style="border-bottom:1px solid #F0F0F0"><b class="upload"></b><a menu="uploadfile" href="javascript:;">上传文件</a></li--><li><b class="themes"></b><a menu="themes" href="javascript:;">主题设置</a></li><li><b class="setting"></b><a menu="setting" href="javascript:;">桌面设置</a></li><li style="border-bottom:1px solid #F0F0F0"><a href="javascript:;">图标设置<b class="arrow">»</b></a><div class="popup-menu" style="display:none"><ul><li><b class="hook"></b><a menu="orderby" orderby="x" href="javascript:;">横向排列</a></li><li><b class="hook"></b><a menu="orderby" orderby="y" href="javascript:;">纵向排列</a></li></ul></div></li><li><a menu="logout" href="javascript:;">注销</a></li></ul></div>');
				$('body').append(TEMP.popupMenuDesk);
				$('.desk-menu').on('contextmenu', function(){
					return false;
				});
				//绑定事件
				$('.desk-menu li').off('mouseover').off('mouseout').on('mouseover', function(){
					if($(this).children('a').next() != ''){
						$(this).children('a').addClass('focus');
						if($(document).width() - $('.desk-menu').offset().left > 250){
							$(this).children('div').css({
								left : 122,
								top : -2
							});
						}else{
							$(this).children('div').css({
								left : -126,
								top : -2
							});
						}
						$(this).children('div').show();
					}
				}).on('mouseout', function(){
					$(this).children('a').removeClass('focus');
					$(this).children('div').hide();
				});
				$('.desk-menu a[menu="orderby"]').off('click').on('click', function(){
					var xy = $(this).attr('orderby');
					if(HROS.CONFIG.appXY != xy){
						HROS.app.updateXY(xy, function(){
							HROS.deskTop.appresize();
							HROS.app.getScrollbar();
						});
					}
					$('.popup-menu').hide();
				});
				$('.desk-menu a[menu="refresh"]').on('click', function(){
					HROS.app.get();
					$('.popup-menu').hide();
				});
				$('.desk-menu a[menu="hideall"]').on('click', function(){
					HROS.window.hideAll();
					$('.popup-menu').hide();
				});
				$('.desk-menu a[menu="closeall"]').on('click', function(){
					HROS.window.closeAll();
					$('.popup-menu').hide();
				});
				$('.desk-menu a[menu="addfolder"]').on('click', function(){
					$.dialog({
						id : 'addfolder',
						title : '新建文件夹',
						padding : 0,
						content : editFolderDialogTemp({
							'name' : '新建文件夹',
							'src' : 'img/ui/folder_default.png'
						}),
						ok : function(){
							if($('#folderName').val() != ''){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=addFolder&name=' + $('#folderName').val() + '&icon=' + $('.folderSelector img').attr('src'),
									success : function(folderid){
										$.ajax({
											type : 'POST',
											url : ajaxUrl,
											data : 'ac=addMyApp&id=' + folderid + '&type=folder&desk=' + HROS.CONFIG.desk,
											success : function(){
												HROS.app.get();
											}
										}); 
									}
								});
							}else{
								$('.folderNameError').show();
								return false;
							}
						},
						cancel : true
					});
					$('.folderSelector').off('click').on('click', function(){
						$('.fcDropdown').show();
					});
					$('.fcDropdown_item').off('click').on('click', function(){
						$('.folderSelector img').attr('src', $(this).children('img').attr('src')).attr('idx', $(this).children('img').attr('idx'));
						$('.fcDropdown').hide();
					});
					$('.popup-menu').hide();
				});
				$('.desk-menu a[menu="addpapp"]').on('click', function(){
					$.dialog({
						id : 'addpapp',
						title : '新建私人应用',
						padding : 0,
						content : editPappDialogTemp({
							'width' : 600,
							'height' : 400,
							'type' : 'papp',
							'isresize' : 1
						}),
						ok : function(){
							var name = $('#addpappName').val(),
								url = $('#addpappUrl').val(),
								width = $('#addpappWidth').val(),
								height = $('#addpappHeight').val(),
								type = $('#addpapp input[name="addpappType"]:checked').val(),
								isresize = $('#addpapp input[name="addpappIsresize"]:checked').val();
							if(name != '' && url != '' && width != '' && height != ''){
								$.ajax({
									type : 'POST',
									url : ajaxUrl,
									data : 'ac=addPapp&name=' + name + '&url=' + url + '&width=' + width + '&height=' + height + '&type=' + type + '&isresize=' + isresize,
									success : function(pappid){
										$.ajax({
											type : 'POST',
											url : ajaxUrl,
											data : 'ac=addMyApp&id=' + pappid + '&type=' + type + '&desk=' + HROS.CONFIG.desk,
											success : function(){
												HROS.app.get();
											}
										}); 
									}
								});
							}else{
								alert('信息填写不完整');
							}
						},
						cancel : true
					});
					$('#addpapp input[name="addpappType"]').off('change').on('change', function(){
						if($(this).val() == 'papp'){
							$('#addpapp tbody tr').eq(4).fadeIn();
						}else{
							$('#addpapp tbody tr').eq(4).fadeOut();
						}
					});
					$('.popup-menu').hide();
				});
				$('.desk-menu a[menu="uploadfile"]').on('click', function(){
					HROS.uploadFile.getDialog();
					$('.popup-menu').hide();
				});
				$('.desk-menu a[menu="themes"]').on('click', function(){
					HROS.window.createTemp({
						id : 'ztsz',
						title : '主题设置',
						url : 'sysapp/wallpaper/index.php',
						width : 580,
						height : 520,
						isresize : false,
						isflash : false
					});
					$('.popup-menu').hide();
				});
				$('.desk-menu a[menu="setting"]').on('click', function(){
					HROS.window.createTemp({
						id : 'zmsz',
						title : '桌面设置',
						url : 'sysapp/desksetting/index.php',
						width : 750,
						height : 450,
						isresize : false,
						isflash : false
					});
					$('.popup-menu').hide();
				});
				$('.desk-menu a[menu="logout"]').on('click', function(){
					HROS.base.logout();
					$('.popup-menu').hide();
				});
			}
			$('.desk-menu a[menu="orderby"]').each(function(){
				$(this).prev().hide();
				if($(this).attr('orderby') == HROS.CONFIG.appXY){
					$(this).prev().show();
				}
				$('.popup-menu').hide();
			});
			return TEMP.popupMenuDesk;
		}
	}
})();

/*
**  任务栏
*/
HROS.taskbar = (function(){
	return {
		init : function(){
			$('#task-content-inner').off('click').on('click', 'a.task-item', function(){
				if($(this).hasClass('task-item-current')){
					HROS.window.hide($(this).attr('realid'), $(this).attr('type'));
				}else{
					HROS.window.show2top($(this).attr('realid'), $(this).attr('type'));
				}
			}).off('contextmenu').on('contextmenu', 'a.task-item', function(e){
				$('.popup-menu').hide();
				$('.quick_view_container').remove();
				HROS.taskbar.rightClick($(this), e.clientX, e.clientY);
				return false;
			});
		},
		rightClick: function(obj, x, y){
			$('.popup-menu').hide();
			$('.quick_view_container').remove();
			var popupmenu = HROS.popupMenu.task(obj);
			l = $(document).width() - x < popupmenu.width() ? x - popupmenu.width() : x;
			t = y - popupmenu.height();
			popupmenu.css({
				left : l,
				top : t
			}).show();
			return false;
		},
		pageClick : function(showW, realW){
			var overW = realW - showW;
			if(HROS.CONFIG.dockPos == 'right'){
				$('#task-content-inner').animate({
					marginLeft : 0
				}, 200);
			}else{
				$('#task-content-inner').animate({
					marginRight : 0
				}, 200);
			}
			$('#task-next a').addClass('disable');
			$('#task-pre a').removeClass('disable');
			$('#task-next-btn').off('click').on('click',function(){
				if($(this).hasClass('disable') == false){
					if(HROS.CONFIG.dockPos == 'right'){
						var marginL = parseInt($('#task-content-inner').css('margin-left')) + 114;
						if(marginL >= 0){
							marginL = 0;
							$('#task-next a').addClass('disable');
						}
						$('#task-pre a').removeClass('disable');
						$('#task-content-inner').animate({
							marginLeft : marginL
						}, 200);
					}else{
						var marginR = parseInt($('#task-content-inner').css('margin-right')) + 114;
						if(marginR >= 0){
							marginR = 0;
							$('#task-next a').addClass('disable');
						}
						$('#task-pre a').removeClass('disable');
						$('#task-content-inner').animate({
							marginRight : marginR
						}, 200);
					}
				}
			});
			$('#task-pre-btn').off('click').on('click', function(){
				if($(this).hasClass('disable') == false){
					if(HROS.CONFIG.dockPos == 'right'){
						var marginL = parseInt($('#task-content-inner').css('margin-left')) - 114;
						if(marginL <= overW * -1){
							marginL = overW * -1;
							$('#task-pre a').addClass('disable');
						}
						$('#task-next a').removeClass('disable');
						$('#task-content-inner').animate({
							marginLeft : marginL
						}, 200);
					}else{
						var marginR = parseInt($('#task-content-inner').css('margin-right')) - 114;
						if(marginR <= overW * -1){
							marginR = overW * -1;
							$('#task-pre a').addClass('disable');
						}
						$('#task-next a').removeClass('disable');
						$('#task-content-inner').animate({
							marginRight : marginR
						}, 200);
					}
				}
			});
		},
		resize : function(){
			if(HROS.CONFIG.dockPos == 'left'){
				$('#task-bar').css({
					'left' : 73,
					'right' : 0
				});
				$('#task-content-inner').removeClass('fl');
			}else if(HROS.CONFIG.dockPos == 'right'){
				$('#task-bar').css({
					'left' : 0,
					'right' : 73
				});
				$('#task-content-inner').addClass('fl');
			}else{
				$('#task-bar').css({
					'left' : 0,
					'right' : 0
				});
				$('#task-content-inner').removeClass('fl');
			}
			var w = $('#task-bar').width(), taskItemW = $('#task-content-inner .task-item').length * 114, showW = w - 112;
			if(taskItemW >= showW){
				$('#task-next, #task-pre').show();
				$('#task-content').css('width', showW);
				HROS.taskbar.pageClick(showW, taskItemW);
			}else{
				$('#task-next, #task-pre').hide();
				$('#task-content').css('width','100%');
				$('#task-content-inner').css({
					'margin-left' : 0,
					'margin-right' : 0
				});
			}
		}
	}
})();

HROS.uploadFile = (function(){
	var fileList = [];
	return {
		//获取上传文件对话框
		getDialog : function(){
			var tempData = [];
			for(var i = 0; i < fileList.length; i++){
				tempData.push({
					name : fileList[i].name,
					size : fileList[i].size < 1048576 ? Math.round(fileList[i].size / 1024) + ' kb' : Math.round(fileList[i].size / 1048576 * 100) / 100 + ' mb'
				});
			}
			var list = uploadFileDialogListTemp({
				list : tempData
			});
			//创建上传文件对话框，如果已打开则更新上传列表
			if(typeof($.dialog.list['uploadfile']) == 'object'){
				$('#uploadfile').html(list);
			}else{
				$.dialog({
					id : 'uploadfile',
					title : '上传文件',
					padding : 0,
					content : uploadFileDialogTemp({
						list : list
					}),
					button : [
						{
							name : '上传',
							callback : function(){
								//检测是否是拖拽文件到页面的操作
								if(fileList.length != 0){
									for(var i = 0, file; file = fileList[i]; i++){
										(function(file){
											var fd = new FormData();
											fd.append('xfile', file);
											var xhr = new XMLHttpRequest();
											if(xhr.upload){
												xhr.upload.addEventListener('progress', function(e){
													if(e.lengthComputable){
														$('#uploadfile .filelist:eq(' + file.index + ') .do').html('[&nbsp;--&nbsp;]');
														var loaded = Math.ceil(e.loaded / e.total * 100);
														$('#uploadfile .filelist:eq(' + file.index + ') .progress').css({
															width : loaded + '%'
														});
													}
												}, false);
												xhr.addEventListener('load', function(e){
													if(xhr.readyState == 4 && xhr.status == 200){
														var result = jQuery.parseJSON(e.target.responseText);
														if(result.error == null){
															$('#uploadfile .filelist:eq(' + file.index + ') .do').html('[&nbsp;√&nbsp;]');
														}else{
															$('#uploadfile .filelist:eq(' + file.index + ') .do').html('[&nbsp;×&nbsp;]').attr('title', result.error);
														}
													}
												}, false);
												xhr.open('post', 'ajax.php?ac=html5upload', true);
												xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
												xhr.send(fd);
											}
										})(file);
									}
									fileList = [];
								}
								return false;
							}
						},
						{
							name : '关闭',
							callback : function(){
								fileList = [];
								xhr = null;
							}
						}
					]
				});
			}
		},
		init : function(){
			//拖动上传文件
			if(window.FileReader){
				var oDragWrap = document.body;
				//拖进
				oDragWrap.addEventListener('dragenter', function(e){
					e.preventDefault();
				}, false);
				//拖离
				oDragWrap.addEventListener('dragleave', function(e){
					e.preventDefault();
				}, false);
				//拖来拖去，一定要注意dragover事件一定要清除默认事件，不然会无法触发后面的drop事件
				oDragWrap.addEventListener('dragover', function(e){
					e.preventDefault();
				}, false);
				//扔
				oDragWrap.addEventListener('drop', function(e){
					e.preventDefault();
					HROS.uploadFile.getDialog();
					getFiles(e);
					HROS.uploadFile.getDialog();
				}, false);
			}
			//普通上传
			$('body').on('change', '#uploadfilebtn', function(e){
				getFiles(e);
				HROS.uploadFile.getDialog();
			});
			//绑定删除事件
			$('body').on('click', '#uploadfile .del', function(){
				var list = $(this).parents('.filelist');
				var count = list.index();
				list.slideUp('slow', function(){
					$(this).remove();
				});
				//数据删除
				var tempList = [];
				for(var i = 0; i < fileList.length; i++){
					if(i != count){
						tempList.push(fileList[i]);
					}
				}
				fileList = tempList;
				refreshFiles();
				HROS.uploadFile.getDialog();
			});
			var getFiles = function(e){
				var files = e.target.files || e.dataTransfer.files;
				if(files.length != 0){
					var content = [];
					for(var i = 0; i < files.length; i++){
						if(files[i]['size'] > 104857600){
							content.push("\""+files[i]['name']+"\" 文件过大，请上传小于100MB的文件！")
						}else{
							fileList.push(files[i]);
						}
					}
					if(content != ''){
						contentHtml = content.join('<br>');
						$.dialog({
							padding : 10,
							content : contentHtml
						})
					}
				}
				refreshFiles();
			}
			var refreshFiles = function(){
				for(var i = 0; i < fileList.length; i++){
					fileList[i]['index'] = i;
				}
				console.log(fileList);
			}
		}
	}
})();

/*
**  壁纸
*/
HROS.wallpaper = (function(){
	return {
		/*
		**	获得壁纸
		**	通过ajax到后端获取壁纸信息，同时设置壁纸
		*/
		get : function(fun){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=getWallpaper',
				success : function(msg){
					var w = msg.split('<{|}>');
					HROS.CONFIG.wallpaperState = w[0];
					switch(w[0]){
						case '1':
						case '2':
							HROS.CONFIG.wallpaper = w[1];
							HROS.CONFIG.wallpaperType = w[2];
							HROS.CONFIG.wallpaperWidth = w[3];
							HROS.CONFIG.wallpaperHeight = w[4];
							break;
						case '3':
							HROS.CONFIG.wallpaper = w[1];
							break;
					}
					if(typeof(fun) != 'undefined'){
						fun();
					}
				}
			});
		},
		/*
		**	设置壁纸
		**	平铺和居中可直接用css样式background解决
		**	而填充、适应和拉伸则需要进行模拟
		*/
		set : function(isreload){
			/*
			**  判断壁纸是否需要重新载入
			**  比如当浏览器尺寸改变时，只需更新壁纸，而无需重新载入
			*/
			var isreload = typeof(isreload) == 'undefined' ? true : isreload;
			if(isreload){
				$('#zoomWallpaperGrid').remove();
			}
			var w = $(window).width(), h = $(window).height();
			switch(HROS.CONFIG.wallpaperState){
				case '1':
				case '2':
					switch(HROS.CONFIG.wallpaperType){
						case 'pingpu':
							if(isreload){
								$('body').append('<div id="zoomWallpaperGrid" style="position:absolute;z-index:-10;top:0;left:0;height:100%;width:100%;background:url(' + HROS.CONFIG.wallpaper + ') repeat"></div>');
							}
							break;
						case 'juzhong':
							if(isreload){
								$('body').append('<div id="zoomWallpaperGrid" style="position:absolute;z-index:-10;top:0;left:0;height:100%;width:100%;background:url(' + HROS.CONFIG.wallpaper + ') no-repeat 50% 50%"></div>');
							}
							break;
						case 'tianchong':
							var t = (h - HROS.CONFIG.wallpaperHeight) / 2, l = (w - HROS.CONFIG.wallpaperWidth) / 2;
							if(isreload){
								$('body').append('<div id="zoomWallpaperGrid" style="position:absolute;z-index:-10;left:0;top:0;overflow:hidden;height:' + h + 'px;width:' + w + 'px"><img id="zoomWallpaper" style="position:absolute;height:' + HROS.CONFIG.wallpaperHeight + 'px;width:' + HROS.CONFIG.wallpaperWidth + 'px;top:' + t + 'px;left:' + l + 'px"><div style="position:absolute;height:' + h + 'px;width:' + w + 'px;background:#fff;opacity:0;filter:alpha(opacity=0)"></div></div>');
								$('#zoomWallpaper').attr('src', HROS.CONFIG.wallpaper).on('load', function(){
									$(this).show();
								});
							}else{
								$('#zoomWallpaperGrid, #zoomWallpaperGrid div').css({
									height : h + 'px',
									width : w + 'px'
								});
								$('#zoomWallpaper').css({
									top : t + 'px',
									left : l + 'px'
								});
							}
							break;
						case 'shiying':
							var imgH, imgW, t, l;
							if(HROS.CONFIG.wallpaperHeight / HROS.CONFIG.wallpaperWidth > h / w){
								imgH = h;
								imgW = HROS.CONFIG.wallpaperWidth * (h / HROS.CONFIG.wallpaperHeight);
								t = 0;
								l = (w - imgW) / 2;
							}else if(HROS.CONFIG.wallpaperHeight / HROS.CONFIG.wallpaperWidth < h / w){
								imgW = w;
								imgH = HROS.CONFIG.wallpaperHeight * (w / HROS.CONFIG.wallpaperWidth);
								l = 0;
								t = (h - imgH) / 2;
							}else{
								imgH = HROS.CONFIG.wallpaperHeight;
								imgW = HROS.CONFIG.wallpaperWidth;
								t = l = 0;
							}
							if(isreload){
								$('body').append('<div id="zoomWallpaperGrid" style="position:absolute;z-index:-10;left:0;top:0;overflow:hidden;height:' + h + 'px;width:' + w + 'px"><img id="zoomWallpaper" style="position:absolute;height:' + imgH + 'px;width:' + imgW + 'px;top:' + t + 'px;left:' + l + 'px"><div style="position:absolute;height:' + h + 'px;width:' + w + 'px;background:#fff;opacity:0;filter:alpha(opacity=0)"></div></div>');
								$('#zoomWallpaper').attr('src', HROS.CONFIG.wallpaper).on('load', function(){
									$(this).show();
								});
							}else{
								$('#zoomWallpaperGrid, #zoomWallpaperGrid div').css({
									height : h + 'px',
									width : w + 'px'
								});
								$('#zoomWallpaper').css({
									height : imgH + 'px',
									width : imgW + 'px',
									top : t + 'px',
									left : l + 'px'
								});
							}
							break;
						case 'lashen':
							if(isreload){
								$('body').append('<div id="zoomWallpaperGrid" style="position:absolute;z-index:-10;left:0;top:0;overflow:hidden;height:' + h + 'px;width:' + w + 'px"><img id="zoomWallpaper" style="position:absolute;height:' + h + 'px;width:' + w + 'px;top:0;left:0"><div style="position:absolute;height:' + h + 'px;width:' + w + 'px;background:#fff;opacity:0;filter:alpha(opacity=0)"></div></div>');
								$('#zoomWallpaper').attr('src', HROS.CONFIG.wallpaper).on('load', function(){
									$(this).show();
								});
							}else{
								$('#zoomWallpaperGrid').css({
									height : h + 'px',
									width : w + 'px'
								}).children('#zoomWallpaper, div').css({
									height : h + 'px',
									width : w + 'px'
								});
							}
							break;
					}
					break;
				case '3':
					if(isreload){
						$('body').append('<div id="zoomWallpaperGrid" style="position:absolute;z-index:-10;top:0;left:0;height:100%;width:100%;overflow:hidden"><div></div><iframe id="iframeWallpaper" frameborder="no" border="0" class="iframeWallpaper" style="position:absolute;left:0;top:0;overflow:hidden;width:100%;height:100%" src="' + HROS.CONFIG.wallpaper + '"></iframe></div>');
					}
					break;
			}
		},
		/*
		**	更新壁纸
		**	通过ajax到后端进行更新，同时获得壁纸
		*/
		update : function(wallpaperstate, wallpapertype, wallpaper){
			$.ajax({
				type : 'POST',
				url : ajaxUrl,
				data : 'ac=setWallpaper&wpstate=' + wallpaperstate + '&wptype=' + wallpapertype + '&wp=' + wallpaper,
				success : function(){
					HROS.wallpaper.get(function(){
						HROS.wallpaper.set();
					});
				}
			});
		}
	}
})();

/*
**  小挂件
*/
HROS.widget = (function(){
	return {
//		create : function(id, obj){
//			//判断窗口是否已打开
//			var iswidgetopen = false, widgetid;
//			if(id === 0){
//				widgetid = typeof(obj.num) == 'undefined' || obj.num == '' ? Date.parse(new Date()) : obj.num;
//			}else{
//				widgetid = id;
//			}
//			$('#desk .widget').each(function(){
//				if($(this).attr('widget') == widgetid){
//					iswidgetopen = true;
//				}
//			});
//			//如果没有打开，则进行创建
//			if(iswidgetopen == false){
//				function nextDo(options){
//					$('#desk').append(widgetWindowTemp({
//						'width' : options.width,
//						'height' : options.height,
//						'num' : options.num,
//						'url' : options.url
//					}));
//					var widget = '#widget_' + options.num + '_warp';
//					//绑定小挂件上各个按钮事件
//					HROS.widget.handle($(widget));
//					//绑定小挂件移动
//					HROS.widget.move($(widget));
//				}
//				if(id === 0){
//					var options = {
//						num : typeof(obj.num) == 'undefined' || obj.num == '' ? Date.parse(new Date()) : obj.num,
//						url : obj.url,
//						width : obj.width,
//						height : obj.height
//					};
//					nextDo(options);
//				}else{
//					ZENG.msgbox.show('小挂件正在加载中，请耐心等待...', 6, 100000);
//					$.getJSON(ajaxUrl + '?ac=getMyAppById&id=' + id, function(widget){
//						if(widget != null){
//							ZENG.msgbox._hide();
//							var options = {
//								num : widget['id'],
//								url : widget['url'],
//								width : widget['width'],
//								height : widget['height']
//							};
//							nextDo(options);
//						}else{
//							ZENG.msgbox.show('小挂件加载失败', 5, 2000);
//							return false;
//						}
//					});
//				}
//			}
//		},
		create : function(id, type){
			//判断窗口是否已打开
			var iswidgetopen = false, widgetid;
			$('#desk .widget').each(function(){
				if($(this).attr('realid') == id){
					iswidgetopen = true;
				}
			});
			//如果没有打开，则进行创建
			if(iswidgetopen == false){
				function nextDo(options){
					if(HROS.widget.checkCookie(id, type)){
						if($.cookie('widgetState')){
							widgetState = eval("(" + $.cookie('widgetState') + ")");
							$(widgetState).each(function(){
								if(this.id == options.id){
									options.top = this.top;
									options.left = this.left;
									options.type = this.type;
								}
							});
						}
					}else{
						HROS.widget.addCookie(options.id, options.type, 0, 0);
					}
					$('#desk').append(widgetWindowTemp({
						'width' : options.width,
						'height' : options.height,
						'type' : options.type,
						'id' : 'w_' + options.type + '_' + options.id,
						'realid' : options.id,
						'top' : options.top == '' ? 0 : options.top,
						'left' : options.left == '' ? 0 : options.left,
						'url' : options.url
					}));
					var widgetId = '#w_' + options.type + '_' + options.id;
					//绑定小挂件上各个按钮事件
					HROS.widget.handle($(widgetId));
					//绑定小挂件移动
					HROS.widget.move($(widgetId));
				}
				ZENG.msgbox.show('小挂件正在加载中，请耐心等待...', 6, 100000);
				$.getJSON(ajaxUrl + '?ac=getMyAppById&id=' + id + '&type=' + type, function(widget){
					if(widget != null){
						ZENG.msgbox._hide();
						var options = {
							id : widget['id'],
							url : widget['url'],
							width : widget['width'],
							height : widget['height'],
							type : widget['type']
						};
						nextDo(options);
					}else{
						ZENG.msgbox.show('小挂件加载失败', 5, 2000);
						return false;
					}
				});
			}
		},
		//还原上次退出系统时widget的状态
		reduction : function(){
			if($.cookie('widgetState')){
				var widgetState = eval("(" + $.cookie('widgetState') + ")");
				console.log(widgetState);
				for(var i = 0; i < widgetState.length; i++){
					HROS.widget.create(widgetState[i].id, widgetState[i].type);
				}
			}
		},
		//根据id验证是否存在cookie中
		checkCookie : function(id, type){
			var flag = false;
			if($.cookie('widgetState')){
				widgetState = eval("(" + $.cookie('widgetState') + ")");
				$(widgetState).each(function(){
					if(this.id == id && this.type == type){
						flag = true;
					}
				});
			}
			return flag;
		},
		/*
		**  以下三个方法：addCookie、updateCookie、removeCookie
		**  用于记录widget打开状态以及摆放位置
		**  实现用户二次登入系统时，还原上次widget的状态
		*/
		addCookie : function(id, type, top, left){
			if(!HROS.widget.checkCookie(id, type)){
				var json = [];
				if($.cookie('widgetState')){
					var widgetState = eval("(" + $.cookie('widgetState') + ")"), len = 0;
					for(var i = 0; i < len; i++){
						json.push("{'id':'" + widgetState[i].id + "','type':'" + widgetState[i].type + "','top':'" + widgetState[i].top + "','left':'" + widgetState[i].left + "'}");
					}
				}
				json.push("{'id':'" + id + "','type':'" + type + "','top':'" + top + "','left':'" + left + "'}");
				$.cookie('widgetState', '[' + json.join(',') + ']', {expires : 95});
			}
		},
		updateCookie : function(id, type, top, left){
			if(HROS.widget.checkCookie(id, type)){
				var widgetState = eval("(" + $.cookie('widgetState') + ")"), len = widgetState.length, json = [];
				for(var i = 0; i < len; i++){
					if(widgetState[i].id == id){
						json.push("{'id':'" + id + "','type':'" + type + "','top':'" + top + "','left':'" + left + "'}");
					}else{
						json.push("{'id':'" + widgetState[i].id + "','type':'" + widgetState[i].type + "','top':'" + widgetState[i].top + "','left':'" + widgetState[i].left + "'}");
					}
				}
				$.cookie('widgetState', '[' + json.join(',') + ']', {expires : 95});
			}
		},
		removeCookie : function(id, type){
			if(HROS.widget.checkCookie(id, type)){
				var widgetState = eval("(" + $.cookie('widgetState') + ")"), len = widgetState.length, json = [];
				for(var i = 0; i < len; i++){
					if(widgetState[i].id != id){
						json.push("{'id':'" + widgetState[i].id + "','type':'" + widgetState[i].type + "','top':'" + widgetState[i].top + "','left':'" + widgetState[i].left + "'}");
					}
				}
				$.cookie('widgetState', '[' + json.join(',') + ']', {expires : 95});
			}
		},
		move : function(obj){
			obj.on('mousedown', '.move', function(e){
				var lay, x, y;
				x = e.clientX - obj.offset().left;
				y = e.clientY - obj.offset().top;
				//绑定鼠标移动事件
				$(document).on('mousemove', function(e){
					lay = HROS.maskBox.desk();
					lay.show();
					_l = e.clientX - x;
					_t = e.clientY - y;
					_t = _t < 0 ? 0 : _t;
					obj.css({
						left : _l,
						top : _t
					});
				}).on('mouseup', function(){
					$(this).off('mousemove').off('mouseup');
					if(typeof(lay) !== 'undefined'){
						lay.hide();
					}
					HROS.widget.updateCookie(obj.attr('realid'), obj.attr('type'), _t, _l);
				});
			});
		},
		close : function(id, type){
			var widgetId = '#w_' + type + '_' + id;
			$(widgetId).html('').remove();
			HROS.widget.removeCookie(id, type);
		},
		handle : function(obj){
			obj.on('click', '.ha-close', function(){
				HROS.widget.close(obj.attr('realid'), obj.attr('type'));
			})
		}
	}
})();

/*
**  应用窗口
*/
HROS.window = (function(){
	return {
		/*
		**  创建窗口
		**  自定义窗口：HROS.window.createTemp({title,url,width,height,resize});
		**      因为是自定义窗口，所以id就写0，不能省略
		**      后面参数依次为：标题、地址、宽、高、是否可拉伸、是否为flash
		**      示例：HROS.window.createTemp({title:"百度",url:"http://www.baidu.com",width:800,height:400,isresize:false,isflash:false});
		*/
		createTemp : function(obj){
			$('.popup-menu').hide();
			$('.quick_view_container').remove();
			var type = 'app', id = typeof(obj.id) == 'undefined' || obj.id == '' ? Date.parse(new Date()) : obj.id;
			//判断窗口是否已打开
			var iswindowopen = false;
			$('#task-content-inner a.task-item').each(function(){
				if($(this).attr('realid') == id && $(this).attr('type') == type){
					iswindowopen = true;
					HROS.window.show2top(id, type);
				}
			});
			//如果没有打开，则进行创建
			if(iswindowopen == false){
				function nextDo(options){
					var windowId = '#w_' + options.type + '_' + options.id;
					//新增任务栏
					$('#task-content-inner').prepend(taskTemp({
						'type' : options.type,
						'id' : 't_' + options.type + '_' + options.id,
						'realid' : options.id,
						'title' : options.title,
						'imgsrc' : options.imgsrc
					}));
					$('#task-content-inner').css('width', $('#task-content-inner .task-item').length * 114);
					HROS.taskbar.resize();
					//新增窗口
					TEMP.windowTemp = {
						'width' : options.width,
						'height' : options.height,
						'top' : ($(window).height() - options.height) / 2 <= 0 ? 0 : ($(window).height() - options.height) / 2,
						'left' : ($(window).width() - options.width) / 2 <= 0 ? 0 : ($(window).width() - options.width) / 2,
						'emptyW' : $(window).width() - options.width,
						'emptyH' : $(window).height() - options.height,
						'zIndex' : HROS.CONFIG.createIndexid,
						'type' : options.type,
						'id' : 'w_' + options.type + '_' + options.id,
						'realid' : options.id,
						'title' : options.title,
						'url' : options.url,
						'imgsrc' : options.imgsrc,
						'isresize' : options.isresize == 1 ? true : false,
						'istitlebar' : options.isresize == 1 ? true : false,
						'istitlebarFullscreen' : options.isresize == 1 ? window.fullScreenApi.supportsFullScreen == true ? true : false : false,
						'issetbar' : options.issetbar == 1 ? true : false,
						'isflash' : options.isflash == 1 ? true : false
					};
					$('#desk').append(windowTemp(TEMP.windowTemp));
					$(windowId).data('info', TEMP.windowTemp);
					HROS.CONFIG.createIndexid += 1;
					//iframe加载完毕后
					$(windowId).find('iframe').on('load', function(){
						if(options.isresize){
							//绑定窗口拉伸事件
							HROS.window.resize($(windowId));
						}
						//隐藏loading
						$(windowId + ' .window-frame').children('div').eq(1).fadeOut();
					});
					$(windowId).on('contextmenu',function(){
						return false;
					});
					//绑定窗口上各个按钮事件
					HROS.window.handle($(windowId));
					//绑定窗口移动
					HROS.window.move($(windowId));
					//绑定窗口遮罩层点击事件
					$('.window-mask').off('click').on('click', function(){
						HROS.window.show2top($(this).parents('.window-container').attr('realid'), $(this).parents('.window-container').attr('type'));
					});
					HROS.window.show2top(options.id, options.type);
				}
				nextDo({
					type : 'app',
					id : typeof(obj.id) == 'undefined' || obj.id == '' ? Date.parse(new Date()) : obj.id,
					imgsrc : 'img/ui/default_icon.png',
					title : obj.title,
					url : obj.url,
					width : obj.width,
					height : obj.height,
					isresize : obj.isresize,
					issetbar : false,
					isflash : typeof(obj.isflash) == 'undefined' || obj.id == '' ? true : obj.isflash
				});
			}
		},
		/*
		**  创建窗口
		**  系统窗口：HROS.window.create(id, type);
		**      示例：HROS.window.create(12, 'app');
		*/
		create : function(id, type){
			$('.popup-menu').hide();
			$('.quick_view_container').remove();
			//判断窗口是否已打开
			var iswindowopen = false;
			$('#task-content-inner a.task-item').each(function(){
				if($(this).attr('realid') == id && $(this).attr('type') == type){
					iswindowopen = true;
					HROS.window.show2top(id, type);
				}
			});
			//如果没有打开，则进行创建
			if(iswindowopen == false){
				function nextDo(options){
					var windowId = '#w_' + options.type + '_' + options.id;
					var top = ($(window).height() - options.height) / 2 <= 0 ? 0 : ($(window).height() - options.height) / 2;
					var left = ($(window).width() - options.width) / 2 <= 0 ? 0 : ($(window).width() - options.width) / 2;
					switch(options.type){
						case 'app':
						case 'papp':
							//新增任务栏
							$('#task-content-inner').prepend(taskTemp({
								'type' : options.type,
								'id' : 't_' + options.type + '_' + options.id,
								'realid' : options.id,
								'title' : options.title,
								'imgsrc' : options.imgsrc
							}));
							$('#task-content-inner').css('width', $('#task-content-inner .task-item').length * 114);
							HROS.taskbar.resize();
							//新增窗口
							TEMP.windowTemp = {
								'width' : options.width,
								'height' : options.height,
								'top' : top,
								'left' : left,
								'emptyW' : $(window).width() - options.width,
								'emptyH' : $(window).height() - options.height,
								'zIndex' : HROS.CONFIG.createIndexid,
								'type' : options.type,
								'id' : 'w_' + options.type + '_' + options.id,
								'realid' : options.id,
								'title' : options.title,
								'url' : options.url,
								'imgsrc' : options.imgsrc,
								'isresize' : options.isresize == 1 ? true : false,
								'istitlebar' : options.isresize == 1 ? true : false,
								'istitlebarFullscreen' : options.isresize == 1 ? window.fullScreenApi.supportsFullScreen == true ? true : false : false,
								'issetbar' : options.issetbar == 1 ? true : false,
								'isflash' : options.isflash == 1 ? true : false
							};
							$('#desk').append(windowTemp(TEMP.windowTemp));
							$(windowId).data('info', TEMP.windowTemp);
							HROS.CONFIG.createIndexid += 1;
							//iframe加载完毕后
							$(windowId + ' iframe').on('load', function(){
								if(options.isresize){
									//绑定窗口拉伸事件
									HROS.window.resize($(windowId));
								}
								//隐藏loading
								$(windowId + ' .window-frame').children('div').eq(1).fadeOut();
							});
							$(windowId).on('contextmenu',function(){
								return false;
							});
							//绑定窗口上各个按钮事件
							HROS.window.handle($(windowId));
							//绑定窗口移动
							HROS.window.move($(windowId));
							//绑定窗口遮罩层点击事件
							$('.window-mask').off('click').on('click', function(){
								HROS.window.show2top($(this).parents('.window-container').attr('realid'), $(this).parents('.window-container').attr('type'));
							});
							HROS.window.show2top(options.id, options.type);
							break;
						case 'folder':
							//新增任务栏
							$('#task-content-inner').prepend(taskTemp({
								'type' : options.type,
								'id' : 't_' + options.type + '_' + options.id,
								'realid' : options.id,
								'title' : options.title,
								'imgsrc' : options.imgsrc
							}));
							$('#task-content-inner').css('width', $('#task-content-inner .task-item').length * 114);
							HROS.taskbar.resize();
							//新增窗口
							TEMP.folderWindowTemp = {
								'width' : options.width,
								'height' : options.height,
								'top' : top,
								'left' : left,
								'emptyW' : $(window).width() - options.width,
								'emptyH' : $(window).height() - options.height,
								'zIndex' : HROS.CONFIG.createIndexid,
								'type' : options.type,
								'id' : 'w_' + options.type + '_' + options.id,
								'realid' : options.id,
								'title' : options.title,
								'imgsrc' : options.imgsrc
							};
							$('#desk').append(folderWindowTemp(TEMP.folderWindowTemp));
							$(windowId).data('info', TEMP.folderWindowTemp);
							HROS.CONFIG.createIndexid += 1;
							//载入文件夹内容
							$.getJSON(ajaxUrl + '?ac=getMyFolderApp&folderid=' + options.id, function(sc){
								if(sc != null){
									for(var i = 0; i < sc.length; i++){
										switch(sc[i]['type']){
											case 'app':
											case 'widget':
												$(windowId).find('.folder_body').append(appbtnTemp({
													'top' : 0,
													'left' : 0,
													'title' : sc[i]['name'],
													'type' : sc[i]['type'],
													'id' : 'd_' + sc[i]['type'] + '_' + sc[i]['id'],
													'realid' : sc[i]['id'],
													'imgsrc' : sc[i]['icon']
												}));
												break;
											case 'folder':
												$(windowId).find('.folder_body').append(appbtnTemp({
													'top' : 0,
													'left' : 0,
													'title' : sc[i]['name'],
													'type' : sc[i]['type'],
													'id' : 'd_' + sc[i]['type'] + '_' + sc[i]['id'],
													'realid' : sc[i]['id'],
													'imgsrc' : sc[i]['icon']
												}));
												break;
										}
									}
									HROS.app.move();
								}
								appEvent();
							});
							function appEvent(){
								$(windowId).on('contextmenu', function(){
									return false;
								});
								//绑定文件夹内图标右击事件
								$(windowId + ' .folder_body').on('contextmenu', '.appbtn', function(e){
									$('.popup-menu').hide();
									$('.quick_view_container').remove();
									var popupmenu = HROS.popupMenu.app($(this));
									var l = ($(document).width() - e.clientX) < popupmenu.width() ? (e.clientX - popupmenu.width()) : e.clientX;
									var t = ($(document).height() - e.clientY) < popupmenu.height() ? (e.clientY - popupmenu.height()) : e.clientY;
									popupmenu.css({
										left : l,
										top : t
									}).show();
									return false;
								});
								//绑定窗口缩放事件
								HROS.window.resize($(windowId));
								//隐藏loading
								$(windowId + ' .window-frame').children('div').eq(1).fadeOut();
								//绑定窗口上各个按钮事件
								HROS.window.handle($(windowId));
								//绑定窗口移动
								HROS.window.move($(windowId));
								//绑定窗口遮罩层点击事件
								$('.window-mask').off('click').on('click', function(){
									HROS.window.show2top($(this).parents('.window-container').attr('realid'), $(this).parents('.window-container').attr('type'));
								});
								HROS.window.show2top(options.id, options.type);
							}
							break;
					}
				}
				ZENG.msgbox.show('应用正在加载中，请耐心等待...', 6, 100000);
				$.getJSON(ajaxUrl + '?ac=getMyAppById&id=' + id + '&type=' + type, function(app){
					if(app != null){
						ZENG.msgbox._hide();
						switch(app['type']){
							case 'app':
							case 'papp':
							case 'widget':
							case 'pwidget':
								nextDo({
									type : app['type'],
									id : app['id'],
									title : app['name'],
									imgsrc : app['icon'],
									url : app['url'],
									width : app['width'],
									height : app['height'],
									isresize : app['isresize'],
									issetbar : app['issetbar'],
									isflash : app['isflash']
								});
								break;
							case 'folder':
								nextDo({
									type : app['type'],
									id : app['id'],
									title : app['name'],
									imgsrc : app['icon'],
									width : app['width'],
									height : app['height']
								});
								break;
						}
					}else{
						ZENG.msgbox.show('数据拉取失败', 5, 2000);
						return false;
					}
				});
			}
		},
		close : function(id, type){
			var windowId = '#w_' + type + '_' + id, taskId = '#t_' + type + '_' + id;
			$(windowId).removeData('info').html('').remove();
			$('#task-content-inner ' + taskId).html('').remove();
			$('#task-content-inner').css('width', $('#task-content-inner .task-item').length * 114);
			$('#task-bar, #nav-bar').removeClass('min-zIndex');
			HROS.taskbar.resize();
		},
		closeAll : function(){
			$('#desk .window-container').each(function(){
				HROS.window.close($(this).attr('realid'), $(this).attr('type'));
			});
		},
		hide : function(id, type){
			HROS.window.show2top(id, type);
			var windowId = '#w_' + type + '_' + id, taskId = '#t_' + type + '_' + id;
			$(windowId).css('visibility', 'hidden');
			$('#task-content-inner ' + taskId).removeClass('task-item-current');
			if($(windowId).attr('ismax') == 1){
				$('#task-bar, #nav-bar').removeClass('min-zIndex');
			}
		},
		hideAll : function(){
			$('#task-content-inner a.task-item').removeClass('task-item-current');
			$('#desk-' + HROS.CONFIG.desk).nextAll('div.window-container').css('visibility', 'hidden');
		},
		max : function(id, type){
			HROS.window.show2top(id, type);
			var windowId = '#w_' + type + '_' + id, taskId = '#t_' + type + '_' + id;
			$(windowId + ' .title-handle .ha-max').hide().next(".ha-revert").show();
			$(windowId).attr('ismax',1).animate({
				width : '100%',
				height : '100%',
				top : 0,
				left : 0
			}, 200);
			$('#task-bar, #nav-bar').addClass('min-zIndex');
		},
		revert : function(id, type){
			HROS.window.show2top(id, type);
			var windowId = '#w_' + type + '_' + id, taskId = '#t_' + type + '_' + id;
			$(windowId + ' .title-handle .ha-revert').hide().prev('.ha-max').show();
			var obj = $(windowId), windowdata = obj.data('info');
			obj.attr('ismax',0).animate({
				width : windowdata['width'],
				height : windowdata['height'],
				left : windowdata['left'],
				top : windowdata['top']
			}, 500);
			$('#task-bar, #nav-bar').removeClass('min-zIndex');
		},
		refresh : function(id, type){
			HROS.window.show2top(id, type);
			var windowId = '#w_' + type + '_' + id, taskId = '#t_' + type + '_' + id;
			//判断是应用窗口，还是文件夹窗口
			if($(windowId + '_iframe').length != 0){
				$(windowId + '_iframe').attr('src', $(windowId + '_iframe').attr('src'));
			}else{
				HROS.window.updateFolder(id, type);
			}
		},
		show2top : function(id, type){
			var windowId = '#w_' + type + '_' + id, taskId = '#t_' + type + '_' + id;
			//改变任务栏样式
			$('#task-content-inner a.task-item').removeClass('task-item-current');
			$('#task-content-inner ' + taskId).addClass('task-item-current');
			if($(windowId).attr('ismax') == 1){
				$('#task-bar, #nav-bar').addClass('min-zIndex');
			}
			//改变窗口样式
			$('#desk .window-container .window-container').removeClass('window-current');
			$(windowId).addClass('window-current').css({
				'z-index' : HROS.CONFIG.createIndexid,
				'visibility' : 'visible'
			});
			//改变窗口遮罩层样式
			$('#desk .window-container .window-mask').show();
			$(windowId + ' .window-mask').hide();
			//改变iframe显示
			$('#desk .window-container-flash iframe').hide();
			$(windowId + ' iframe').show();
			HROS.CONFIG.createIndexid += 1;
		},
		updateFolder : function(id, type){
			HROS.window.show2top(id, type);
			var windowId = '#w_' + type + '_' + id, taskId = '#t_' + type + '_' + id;
			$.getJSON(ajaxUrl + '?ac=getMyFolderApp&folderid=' + id, function(sc){
				if(sc != null){
					var folder_append = '';
					for(var i = 0; i < sc.length; i++){
						switch(sc[i]['type']){
							case 'app':
							case 'widget':
								folder_append += appbtnTemp({
									'top' : 0,
									'left' : 0,
									'title' : sc[i]['name'],
									'type' : sc[i]['type'],
									'id' : 'd_' + sc[i]['type'] + '_' + sc[i]['id'],
									'realid' : sc[i]['id'],
									'imgsrc' : sc[i]['icon']
								});
								break;
						}
					}
					$(windowId).find('.folder_body').html('').append(folder_append).on('contextmenu', '.shortcut', function(e){
						$('.popup-menu').hide();
						$('.quick_view_container').remove();
						TEMP.AppRight = HROS.popupMenu.app($(this));
						var l = ($(document).width() - e.clientX) < TEMP.AppRight.width() ? (e.clientX - TEMP.AppRight.width()) : e.clientX;
						var t = ($(document).height() - e.clientY) < TEMP.AppRight.height() ? (e.clientY - TEMP.AppRight.height()) : e.clientY;
						TEMP.AppRight.css({
							left : l,
							top : t
						}).show();
						return false;
					});
					HROS.app.move();
				}
			});
		},
		handle : function(obj){
			obj.on('dblclick', '.title-bar', function(e){
				//判断当前窗口是否已经是最大化
				if(obj.find('.ha-max').is(':hidden')){
					obj.find('.ha-revert').click();
				}else{
					obj.find('.ha-max').click();
				}
			}).on('click', '.ha-hide', function(){
				HROS.window.hide(obj.attr('realid'), obj.attr('type'));
			}).on('click', '.ha-max', function(){
				HROS.window.max(obj.attr('realid'), obj.attr('type'));
			}).on('click', '.ha-revert', function(){
				HROS.window.revert(obj.attr('realid'), obj.attr('type'));
			}).on('click', '.ha-fullscreen', function(){
				window.fullScreenApi.requestFullScreen(document.getElementById(obj.find('iframe').attr('id')));
			}).on('click', '.ha-close', function(){
				HROS.window.close(obj.attr('realid'), obj.attr('type'));
			}).on('click', '.refresh', function(){
				HROS.window.refresh(obj.attr('realid'), obj.attr('type'));
			}).on('click', '.help', function(){
				var help = art.dialog({
					title : '帮助',
					follow : this,
					width : 196
				});
				$.ajax({
					type : 'POST',
					url : ajaxUrl,
					data : 'ac=getAppRemark&id=' + obj.data('info').realid,
					success : function(msg){
						help.content(msg);
					}
				});
			}).on('click', '.star', function(){
				$.ajax({
					type : 'POST',
					url : ajaxUrl,
					data : 'ac=getAppStar&id=' + obj.data('info').realid,
					success : function(point){
						$.dialog({
							title : '给“' + obj.data('info').title + '”打分',
							width : 250,
							id : 'star',
							content : starDialogTemp({
								'point' : Math.floor(point),
								'realpoint' : point * 20
							})
						});
						$('#star ul').data('id', obj.data('info').realid);
					}
				});
				$('body').off('click').on('click', '#star ul li', function(){
					var num = $(this).attr('num');
					var id = $(this).parent('ul').data('id');
					if(!isNaN(num) && /^[1-5]$/.test(num)){
						$.ajax({
							type : 'POST',
							url : ajaxUrl,
							data : 'ac=updateAppStar&id=' + id + '&starnum=' + num,
							success : function(msg){
								art.dialog.list['star'].close();
								if(msg){
									ZENG.msgbox.show("打分成功！", 4, 2000);
								}else{
									ZENG.msgbox.show("你已经打过分了！", 1, 2000);
								}
							}
						});
					}
				});
			}).on('contextmenu', '.window-container', function(){
				$('.popup-menu').hide();
				$('.quick_view_container').remove();
				return false;
			});
		},
		move : function(obj){
			obj.on('mousedown', '.title-bar', function(e){
				if(obj.attr('ismax') == 1){
					return false;
				}
				HROS.window.show2top(obj.attr('realid'), obj.attr('type'));
				var windowdata = obj.data('info'), lay, x, y;
				x = e.clientX - obj.offset().left;
				y = e.clientY - obj.offset().top;
				//绑定鼠标移动事件
				$(document).on('mousemove', function(e){
					lay = HROS.maskBox.desk();
					lay.show();
					//强制把右上角还原按钮隐藏，最大化按钮显示
					obj.find('.ha-revert').hide().prev('.ha-max').show();
					_l = e.clientX - x;
					_t = e.clientY - y;
					_w = windowdata['width'];
					_h = windowdata['height'];
					//窗口贴屏幕顶部10px内 || 底部60px内
					_t = _t <= 10 ? 0 : _t >= lay.height()-30 ? lay.height()-30 : _t;
					obj.css({
						width : _w,
						height : _h,
						left : _l,
						top : _t
					});
					obj.data('info').left = obj.offset().left;
					obj.data('info').top = obj.offset().top;
				}).on('mouseup', function(){
					$(this).off('mousemove').off('mouseup');
					if(typeof(lay) !== 'undefined'){
						lay.hide();
					}
				});
			});
		},
		resize : function(obj){
			obj.find('div.window-resize').on('mousedown', function(e){
				//增加背景遮罩层
				var resizeobj = $(this), lay, x = e.clientX, y = e.clientY, w = obj.width(), h = obj.height();
				$(document).on('mousemove', function(e){
					lay = HROS.maskBox.desk();
					lay.show();
					_x = e.clientX;
					_y = e.clientY;
					//当拖动到屏幕边缘时，自动贴屏
					_x = _x <= 10 ? 0 : _x >= (lay.width()-12) ? (lay.width()-2) : _x;
					_y = _y <= 10 ? 0 : _y >= (lay.height()-12) ? lay.height() : _y;
					switch(resizeobj.attr('resize')){
						case 't':
							h + y - _y > HROS.CONFIG.windowMinHeight ? obj.css({
								height : h + y - _y,
								top : _y
							}) : obj.css({
								height : HROS.CONFIG.windowMinHeight
							});
							break;
						case 'r':
							w - x + _x > HROS.CONFIG.windowMinWidth ? obj.css({
								width : w - x + _x
							}) : obj.css({
								width : HROS.CONFIG.windowMinWidth
							});
							break;
						case 'b':
							h - y + _y > HROS.CONFIG.windowMinHeight ? obj.css({
								height : h - y + _y
							}) : obj.css({
								height : HROS.CONFIG.windowMinHeight
							});
							break;
						case 'l':
							w + x - _x > HROS.CONFIG.windowMinWidth ? obj.css({
								width : w + x - _x,
								left : _x
							}) : obj.css({
								width : HROS.CONFIG.windowMinWidth
							});
							break;
						case 'rt':
							h + y - _y > HROS.CONFIG.windowMinHeight ? obj.css({
								height : h + y - _y,
								top : _y
							}) : obj.css({
								height : HROS.CONFIG.windowMinHeight
							});
							w - x + _x > HROS.CONFIG.windowMinWidth ? obj.css({
								width : w - x + _x
							}) : obj.css({
								width : HROS.CONFIG.windowMinWidth
							});
							break;
						case 'rb':
							w - x + _x > HROS.CONFIG.windowMinWidth ? obj.css({
								width : w - x + _x
							}) : obj.css({
								width : HROS.CONFIG.windowMinWidth
							});
							h - y + _y > HROS.CONFIG.windowMinHeight ? obj.css({
								height : h - y + _y
							}) : obj.css({
								height : HROS.CONFIG.windowMinHeight
							});
							break;
						case 'lt':
							w + x - _x > HROS.CONFIG.windowMinWidth ? obj.css({
								width : w + x - _x,
								left : _x
							}) : obj.css({
								width : HROS.CONFIG.windowMinWidth
							});
							h + y - _y > HROS.CONFIG.windowMinHeight ? obj.css({
								height : h + y - _y,
								top : _y
							}) : obj.css({
								height : HROS.CONFIG.windowMinHeight
							});
							break;
						case 'lb':
							w + x - _x > HROS.CONFIG.windowMinWidth ? obj.css({
								width : w + x - _x,
								left : _x
							}) : obj.css({
								width : HROS.CONFIG.windowMinWidth
							});
							h - y + _y > HROS.CONFIG.windowMinHeight ? obj.css({
								height : h - y + _y
							}) : obj.css({
								height : HROS.CONFIG.windowMinHeight
							});
							break;
					}
				}).on('mouseup',function(){
					if(typeof(lay) !== 'undefined'){
						lay.hide();
					}
					obj.data('info').width = obj.width();
					obj.data('info').height = obj.height();
					obj.data('info').left = obj.offset().left;
					obj.data('info').top = obj.offset().top;
					obj.data('info').emptyW = $(window).width() - obj.width();
					obj.data('info').emptyH = $(window).height() - obj.height();
					$(this).off('mousemove').off('mouseup');
				});
			});
		}
	}
})();

/*
**  一个从QQ空间提取出来的功能，进行了二次包装
**  用于判断页面是否处于缩放状态中，并给予提示
**  可在浏览页时按住ctrl+鼠标滚轮进行测试预览
*/
HROS.zoom = (function(){
	return {
		/*
		**  初始化
		**  其实也不用初始化，可以直接把object代码写在页面上
		**  需要注意的是onchange参数，调用的是HROS.zoom.check方法
		*/
		init : function(){
			$('body').append('<div id="zoombox"></div>');
			/*
			**  使用SWFObject.js插入flash
			**  http://www.cnblogs.com/wuxinxi007/archive/2009/10/27/1590709.html
			*/
			swfobject.embedSWF('js/zoom.swf?onchange=HROS.zoom.check', 'zoombox', '10', '10', '6.0.0', 'expressInstall.swf', '', {allowScriptAccess : 'always', wmode : 'transparent', scale : 'noScale'}, {id : 'accessory_zoom', name : 'zoom_detect'});
		},
		/*
		**  为什么会有个参数o？其实我也不知道
		**  我只知道o.scale的值是数字，当o.scale大于1时，页面处于放大状态，反之则为缩小状态
		*/
		check : function(o){
			var s = o.scale, m = s > 1 ? '放大' : '缩小';
			if(s != 1){
				zoomlevel = s;
				$('#zoom-tip').show().find('span').text('您的浏览器目前处于' + m + '状态，会导致显示不正常，您可以键盘按“ctrl+数字0”组合键恢复初始状态！');
			}else{
				if(s != zoomlevel){
					$('#zoom-tip').fadeOut();
				}
			}
		},
		/*
		**  关闭，其实是删除，如果想做关闭，把代码改成hide()即可
		*/
		close : function(){
			$('#zoom-tip').remove();
		}
	}
})();