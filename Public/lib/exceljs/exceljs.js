require.config( {
	baseUrl : 'lib/exceljs/',
	text : 'text.js',
	paths : {
		underscore : 'underscore-min',
		JSZip : 'jszip',
		EB : 'excel-builder.js'
	},
	shim : {
		'underscore' : {
			exports : '_'
		},
		'JSZip' : {
			exports : 'JSZip'
		}
	}
});
function grid2excel(tableid,title) {
	var gridjson = eval('(' + jQuery("#" + tableid).jqGrid('jqGridExport', {
							exptype : 'jsonstring'
						}).replace(/\n /g,"").replace(/\r /g,"")
					+ ')').grid;
	
	var count = gridjson.rowNum;
	var columns = [];
	var data = gridjson.data;
	var exceldata = [];
	var headerrow = [];
	$.each(gridjson.colModel, function(i, v) {
		if (!gridjson.colModel[i].hidden) {
			v.text = gridjson.colNames[i];
			columns.push(v);
			headerrow.push(v.text);
		}
	});
	exceldata.push(headerrow);

	$.each(data, function(i, v) {
		var datarow = [];
		$.each(columns, function(ii, vv) {
			datarow.push(v[vv.name]);
		});
		exceldata.push(datarow);
	});

	require( [ 'excel-builder.js/excel-builder', 'download' ], function(EB,
			downloader) {
		var artistWorkbook = EB.createWorkbook();
		var albumList = artistWorkbook.createWorksheet( {
			name : 'sheet1'
		});
			albumList.setData(exceldata);
			artistWorkbook.addWorksheet(albumList);

			var data = EB.createFile(artistWorkbook);
			$('<a/>',{
				id:'downloadLink',
				text:title,
				download:title,
				href:'data:application/vnd.ms-excel;base64,'+data
			}).appendTo('body')[0].click();
			$('#downloadLink').remove();
		});

}
