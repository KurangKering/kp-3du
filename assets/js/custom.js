'use strict';

var swalInfo = function (paramTitle, paramType, paramText, paramTimer = 1000) {
	return Swal.fire({
		title: paramTitle,
		type: paramType,
		text: paramText,
		timer: paramTimer,
		showCancelButton: false,
		showConfirmButton: false,
		allowOutsideClick: false,
	});
}


let generateBarang = (function (settings) {
	//options
	var options = $.extend({
		data: [],
		dom: {
			$btnSubmit: $("#btn-submit"),
			$btnTambah: $('#btnAddBarang'),
			$form: $("#form-peminjaman"),
			$select: $('#addNamaBarang'),
			$inputJumlah: $('#addJumlah'),
			$content: $('#tbody-daftar-peminjaman'),
		},
		submitData: function (e) { },
		addFromClick: addFromClick,
	}, settings);

	//bind events
	options.dom.$btnTambah.on('click', options.addFromClick);
	options.dom.$form.on('submit', options.submitData);
	//methods
	function addFromClick() {
		options.dom.$select.focus();
		let id = options.dom.$select.val();
		let nama = options.dom.$select.find(':selected').text();
		let jumlah = options.dom.$inputJumlah.val();
		let satuan = options.dom.$select.find(':selected').data('satuan');
		let sisaTersedia = options.dom.$select.find(':selected').data('sisa');
		let obj = {
			id: id,
			nama: nama,
			jumlah: jumlah,
			satuan: satuan,
			sisa: sisaTersedia,

		};
		if (validasiBarang(obj)) {
			options.data.push(obj);
			populateTable();
		}
	}
	function validasiBarang(obj) {
		if (obj.jumlah <= 0 || obj.id == '') return false;
		if (checkBarang(options.data, obj.id) === false && obj.id != null && obj.jumlah != '')
			return true;
	}
	function populateTable() {
		var data = options.data;
		var el = options.dom.$content;
		emptyTable(el);
		$.each(data.reverse(), function (index, val) {
			val.det_peminjaman_barang_id = val.det_peminjaman_barang_id || "undefined";

			var noPage = data.length - index;
			var tr = $("<tr/>");
			tr.append($("<td/>", {
				text: noPage,
				class: 'text-center',
				style: "vertical-align:middle;"
			}))
				.append($("<td/>", {
					text: val.nama,
					style: "vertical-align:middle;"
				}))

				.append($("<td/>", {
					text: val.sisa,
					style: "vertical-align:middle;"
				}))
				.append($("<td/>", {
					class: 'text-center'
				})
					.append($("<input/>", {
						type: 'number',
						name: 'val_jumlah[]',
						attr: { 'data-id': val.id },
						value: val.jumlah,
						class: 'form-control',
					})
						.keyup(function (e) {
							var dataID = $(this).data('id');
							var jumlah = $(this).val();
							$.each(options.data, function (index, _data) {
								if (_data.id == dataID) {
									options.data[index].jumlah = jumlah;
									return;
								}
							});
						})))
				.append($("<td/>", {
					text: val.satuan,
					style: "vertical-align:middle;"
				}))
				.append($("<td/>", {
					class: 'text-center'
				})
					.append($("<button/>", {
						'data-id_jabatan': val.id,
						type: 'button',
						class: 'btn btn-danger btn-hapus-jabatans',
						text: 'Hapus'
					})
						.click(function (event) {
							options.data.splice(index, 1);
							options.data.reverse();
							populateTable();
						})))
				.append($("<input>", {
					type: "hidden",
					name: "val_id[]",
					value: val.id
				}))
				.append($("<input>", {
					type: "hidden",
					name: "val_sisa[]",
					value: val.sisa
				}))
				.append($("<input>", {
					type: "hidden",
					name: "val_det_id[]",
					value: val.det_peminjaman_barang_id
				}));
			el.append(tr);
		});
	}
	function checkBarang(data, id) {
		var index = false;
		for (var i = 0; i < data.length; i++) {
			if (data[i].id == id) {
				index = i;
				break;
			}
		}
		return index;
	}
	function emptyTable(el) {
		el.empty();
	}
	(function () {
		populateTable();
	})();
	return {
		dom: options.dom,
		data: options.data,
		validasiBarang: validasiBarang,
		populateTable: populateTable,
	}
});


let generateInventaris = (function (settings) {
	//options
	var options = $.extend({
		data: [],
		dom: {
			$btnSubmit: $("#btn-submit"),
			$btnTambah: $('#btnAddInventaris'),
			$form: $("#form-peminjaman"),
			$select: $('#addNamaInventaris'),
			$inputJumlah: $('#addJumlah'),
			$content: $('#tbody-daftar-peminjaman'),
		},
		submitData: function (e) { },
		addFromClick: addFromClick,
		populateTable: populateTable,
	}, settings);

	//bind events
	options.dom.$btnTambah.on('click', options.addFromClick);
	options.dom.$form.on('submit', options.submitData);
	//methods
	function addFromClick() {
		options.dom.$select.focus();
		let id = options.dom.$select.val();
		let nama = options.dom.$select.find(':selected').text();
		let jumlah = options.dom.$inputJumlah.val();
		let satuan = options.dom.$select.find(':selected').data('satuan');
		let obj = {
			id: id,
			nama: nama,
			jumlah: jumlah,
			satuan: satuan,

		};
		if (validasiBarang(obj)) {
			options.data.push(obj);
			populateTable();
		}
	}
	function validasiBarang(obj) {
		if (obj.jumlah <= 0 || obj.id == '') return false;
		if (checkBarang(options.data, obj.id) === false && obj.id != null && obj.jumlah != '')
			return true;
	}
	function populateTable() {
		var data = options.data;
		var el = options.dom.$content;
		emptyTable(el);
		$.each(data.reverse(), function (index, val) {
			val.det_pengajuan_inventaris_id = val.det_pengajuan_inventaris_id || "undefined";

			var noPage = data.length - index;
			var tr = $("<tr/>");
			tr.append($("<td/>", {
				text: noPage,
				class: 'text-center',
				style: "vertical-align:middle;"
			}))
				.append($("<td/>", {
					text: val.nama,
					style: "vertical-align:middle;"
				}))

				.append($("<td/>", {
					class: 'text-center'
				})
					.append($("<input/>", {
						type: 'number',
						name: 'val_jumlah[]',
						attr: { 'data-id': val.id },
						value: val.jumlah,
						class: 'form-control',
					})
						.keyup(function (e) {
							var dataID = $(this).data('id');
							var jumlah = $(this).val();
							$.each(options.data, function (index, _data) {
								if (_data.id == dataID) {
									options.data[index].jumlah = jumlah;
									return;
								}
							});
						})))
				.append($("<td/>", {
					text: val.satuan,
					style: "vertical-align:middle;"
				}))
				.append($("<td/>", {
					class: 'text-center'
				})
					.append($("<button/>", {
						'data-id_jabatan': val.id,
						type: 'button',
						class: 'btn btn-danger btn-hapus-jabatans',
						text: 'Hapus'
					})
						.click(function (event) {
							options.data.splice(index, 1);
							options.data.reverse();
							populateTable();
						})))
				.append($("<input>", {
					type: "hidden",
					name: "val_id[]",
					value: val.id
				}))
				.append($("<input>", {
					type: "hidden",
					name: "val_sisa[]",
					value: val.sisa
				}))
				.append($("<input>", {
					type: "hidden",
					name: "val_det_id[]",
					value: val.det_pengajuan_inventaris_id
				}));
			el.append(tr);
		});
	}
	function checkBarang(data, id) {
		var index = false;
		for (var i = 0; i < data.length; i++) {
			if (data[i].id == id) {
				index = i;
				break;
			}
		}
		return index;
	}
	function emptyTable(el) {
		el.empty();
	}
	(function () {
		populateTable();
	})();
	return {
		dom: options.dom,
		data: options.data,
		validasiBarang: validasiBarang,
		populateTable: populateTable,
		emptyTable: emptyTable,
	}
});
let genPermintaanInventaris = (function (settings) {
	//options
	var options = $.extend({
		data: [],
		dom: {
			$btnSubmit: $("#btn-submit"),
			$btnTambah: $('#btnAddInventaris'),
			$form: $("#form-peminjaman"),
			$select: $('#addNamaInventaris'),
			$inputJumlah: $('#addJumlah'),
			$content: $('#tbody-daftar-permintaan'),
		},
		submitData: function (e) { },
		addFromClick: addFromClick,
	}, settings);

	//bind events
	options.dom.$btnTambah.on('click', options.addFromClick);
	options.dom.$form.on('submit', options.submitData);
	//methods
	function addFromClick() {
		options.dom.$select.focus();
		let id = options.dom.$select.val();
		let nama = options.dom.$select.find(':selected').text();
		let satuan = options.dom.$select.find(':selected').data('satuan');
		let stockTersedia = a.dom.$select.find(':selected').data('stock');
		let jumlah = a.dom.$inputJumlah.val();

		if (stockTersedia < jumlah || stockTersedia == 0) {
			a.dom.$inputJumlah.val('');
			return;
		}
		let obj = {
			id: id,
			nama: nama,
			jumlah: jumlah,
			satuan: satuan,
			stock: stockTersedia,

		};
		if (validasiBarang(obj)) {
			options.data.push(obj);
			populateTable();
		}
	}
	function validasiBarang(obj) {
		if (obj.jumlah <= 0 || obj.id == '') return false;
		if (checkBarang(options.data, obj.id) === false && obj.id != null && obj.jumlah != '')
			return true;
	}
	function populateTable() {
		var data = options.data;
		var el = options.dom.$content;
		emptyTable(el);
		$.each(data.reverse(), function (index, val) {
			val.det_pengajuan_inventaris_id = val.det_pengajuan_inventaris_id || "undefined";

			var noPage = data.length - index;
			var tr = $("<tr/>");
			tr.append($("<td/>", {
				text: noPage,
				class: 'text-center',
				style: "vertical-align:middle;"
			}))
				.append($("<td/>", {
					text: val.nama,
					style: "vertical-align:middle;"
				}))
				.append($("<td/>", {
					text: val.stock,
					style: "vertical-align:middle;"
				}))

				.append($("<td/>", {
					class: 'text-center'
				})
					.append($("<input/>", {
						type: 'number',
						name: 'val_jumlah[]',
						attr: { 'data-id': val.id },
						value: val.jumlah,
						class: 'form-control',
					})
						.keyup(function (e) {
							var dataID = $(this).data('id');
							var jumlah = $(this).val();
							$.each(options.data, function (index, _data) {
								if (_data.id == dataID) {
									options.data[index].jumlah = jumlah;
									return;
								}
							});
						})))
				.append($("<td/>", {
					text: val.satuan,
					style: "vertical-align:middle;"
				}))
				.append($("<td/>", {
					class: 'text-center'
				})
					.append($("<button/>", {
						'data-id_jabatan': val.id,
						type: 'button',
						class: 'btn btn-danger btn-hapus-jabatans',
						text: 'Hapus'
					})
						.click(function (event) {
							options.data.splice(index, 1);
							options.data.reverse();
							populateTable();
						})))
				.append($("<input>", {
					type: "hidden",
					name: "val_id[]",
					value: val.id
				}))
				.append($("<input>", {
					type: "hidden",
					name: "val_stock[]",
					value: val.stock
				}))
				.append($("<input>", {
					type: "hidden",
					name: "val_det_id[]",
					value: val.det_permintaan_inventaris_id
				}));
			el.append(tr);
		});
	}
	function checkBarang(data, id) {
		var index = false;
		for (var i = 0; i < data.length; i++) {
			if (data[i].id == id) {
				index = i;
				break;
			}
		}
		return index;
	}
	function emptyTable(el) {
		el.empty();
	}
	(function () {
		populateTable();
	})();
	return {
		dom: options.dom,
		data: options.data,
		validasiBarang: validasiBarang,
		populateTable: populateTable,
	}
});


let generateInventarisRuangan = (function (settings) {
	//options
	var options = $.extend({
		data: [],
		dom: {
			$btnSubmit: $("#btn-submit"),
			$btnTambah: $('#btnAddInventarisRuangan'),
			$form: $("#form-ruangan"),
			$inputNamaInventaris: $('#addNamaInventaris'),
			$inputJumlah: $('#addJumlah'),
			$inputSatuan: $('#addSatuan'),
			$content: $('#tbody-daftar-inventaris'),
		},
		submitData: function (e) { },
		addFromClick: addFromClick,
		populateTable: populateTable,
	}, settings);

	//bind events
	options.dom.$btnTambah.on('click', options.addFromClick);
	options.dom.$form.on('submit', options.submitData);
	//methods
	function addFromClick() {
		console.log('welcome');
		let namaInventaris = options.dom.$inputNamaInventaris.val();
		let jumlah = options.dom.$inputJumlah.val();
		let satuan = options.dom.$inputSatuan.val();
		let obj = {
			det_ruangan_id: null,
			nama: namaInventaris,
			jumlah: jumlah,
			satuan: satuan,

		};
		if (validasiBarang(obj)) {
			options.data.push(obj);
			populateTable();
		}
	}
	function validasiBarang(obj) {
		if (obj.jumlah <= 0 || obj.nama == '' || obj.satuan == '') return false;
		return true;
		// if (checkBarang(options.data, obj.id) === false && obj.id != null && obj.jumlah != '')
		// return true;	
	}
	function populateTable() {
		var data = options.data;
		var el = options.dom.$content;
		emptyTable(el);
		$.each(data.reverse(), function (index, val) {
			val.det_ruangan_id = val.det_ruangan_id || "undefined";

			var noPage = index + 1;
			var tr = $("<tr/>");
			tr.append($("<td/>", {
				text: noPage,
				class: 'text-center',
				style: "vertical-align:middle;"
			}))
				.append($("<td/>", {
					text: val.nama,
					style: "vertical-align:middle;"
				}))

				.append($("<td/>", {
					class: 'text-center'
				})
					.append($("<input/>", {
						type: 'number',
						name: 'val_jumlah[]',
						attr: { 'data-det_ruangan_id': val.det_ruangan_id },
						value: val.jumlah,
						class: 'form-control',
					})
						.keyup(function (e) {
							var dataID = $(this).data('det_ruangan_id');
							var jumlah = $(this).val();
							$.each(options.data, function (index, _data) {
								if (_data.det_ruangan_id == dataID) {
									options.data[index].jumlah = jumlah;
									return;
								}
							});
						})))
				.append($("<td/>", {
					text: val.satuan,
					style: "vertical-align:middle;"
				}))
				.append($("<td/>", {
					class: 'text-center'
				})
				.append($("<button/>", {
					type: 'button',
					class: 'btn btn-danger btn-hapus',
					text: 'Hapus'
				})
					.click(function (event) {
						options.data.splice(index, 1);
						options.data.reverse();
						populateTable();
					})))
				.append($("<input>", {
					type: "hidden",
					name: "val_detal_ruangan_id[]",
					value: val.det_ruangan_id
				}));
			el.append(tr);
		});
	}
	function checkBarang(data, id) {
		var index = false;
		for (var i = 0; i < data.length; i++) {
			if (data[i].id == id) {
				index = i;
				break;
			}
		}
		return index;
	}
	function emptyTable(el) {
		el.empty();
	}
	(function () {
		populateTable();
	})();
	return {
		dom: options.dom,
		data: options.data,
		validasiBarang: validasiBarang,
		populateTable: populateTable,
		emptyTable: emptyTable,
	}
});