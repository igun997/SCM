<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{url("assets/images/logo.png")}}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{url("assets/images/logo.png")}}" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>@yield("title","Beranda")</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@8.17.1/dist/sweetalert2.min.css" integrity="sha256-zfoprrAG5QCLwEZhI7DWYoqRWYaVYxdjd0mEF3Hl9k0=" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{url("assets/plugins/jbox/jBox.all.css")}}">
    <link rel="stylesheet" href="{{url("assets/plugins/cartjs/dist/css/smart_cart.min.css")}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style media="screen">
      .table thead th, .text-wrap table thead th {
        white-space: nowrap !important;
      }
      .jBox-content{
        max-height: 500px !important;
        overflow-y: auto;
      }
    </style>
    @stack("css")
    <script src="{{url("assets/js/require.min.js")}}"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->

    <link href="{{url("assets/css/dashboard.css")}}" rel="stylesheet" />
    <link href="//cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css" rel="stylesheet" />
    <script src="{{url("assets/js/dashboard.js")}}"></script>
    <!-- c3.js Charts Plugin -->
    <!-- <link href="{{url("assets/plugins/charts-c3/plugin.css")}}" rel="stylesheet" /> -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/c3/0.7.12/c3.min.css">
    <script src="{{url("assets/plugins/charts-c3/plugin.js")}}"></script>
    <!-- Google Maps Plugin -->
    <link href="{{url("assets/plugins/maps-google/plugin.css")}}" rel="stylesheet" />
    <script src="{{url("assets/plugins/maps-google/plugin.js")}}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{url("assets/plugins/input-mask/plugin.js")}}"></script>
    <script src="{{url("assets/plugins/datatables/plugin.js")}}"></script>

    <style media="screen">
    .swal2-container {
      z-index: 1000000000000000 !important;
    }
    .lds-dual-ring {
      display: inline-block;
      width: 64px;
      height: 64px;
      -webkit-animation:spin 1s linear infinite;
     -moz-animation:spin 1s linear infinite;
     animation:spin 1s linear infinite;
    }

    @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
    @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
    @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
    #overlay {
      position: fixed; /* Sit on top of the page content */
      display: none; /* Hidden by default */
      width: 100%; /* Full width (cover the whole page) */
      height: 100%; /* Full height (cover the whole page) */
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5); /* Black background with opacity */
      z-index: 10000000000; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */
    }
    #text{
      position: absolute;
      top: 50%;
      left: 50%;
      font-size: 50px;
      color: white;
      transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
    }
    </style>
  </head>
  <body class="">
     <div id="overlay">
       <div id="text">
           <img class="lds-dual-ring" src="{{url("assets/images/logo.png")}}" alt="">
       </div>
     </div>
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="./index.html">
                <img src="{{url("assets/images/strip-logo.png")}}" class="header-brand-img" alt="tabler logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                @if(session()->get("level") != null)
                @include("layout.partial.userinfo")
                @endif
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>
        @if(session()->get("level") != null)
        @include("layout.partial.menus")
        @endif
        <div class="my-3 my-md-5">
          <div class="container">
            @yield("content")
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
                <div class="col-auto">
                  <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="">Panduan Aplikasi</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © {{date("Y")}} <a href=".">LOVA</a>. Created by SystemFive All rights reserved.
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
  <script type="text/javascript">
  const jenis = [
        {
          value:"mobil",
          text:"Mobil"
        },{
          value:"motor",
          text:"Motor"
        },{
          value:"pesawat",
          text:"Pesawat"
        },{
          value:"kapal",
          text:"Kapal"
        }
    ];
  const status_kendaraan = [
        {
          value:"0",
          text:"Aktif"
        },{
          value:"1",
          text:"Rusak"
        },{
          value:"2",
          text:"Terpakai"
        }
    ];
    function status_retur($id)
    {
      if ($id == 0) {
        return "Menunggu Konfirmasi Bag. Pengadaan";
      }else if ($id == 1) {
        return "Ditolak Oleh Bag. Pengadaan";
      }else if ($id == 2) {
        return "Menunggu Konfirmasi Direktur";
      }else if ($id == 3) {
        return "Ditolak Oleh Bag. Direktur";
      }else if ($id == 4) {
        return "Selesai";
      }else {
        return "Tidak Diketahui";
      }
    }
    function status_pengadaan($id)
    {
      if ($id == 0) {
        return "Menunggu Verifikasi Direktur";
      }else if ($id == 1) {
        return "Ditolak Oleh Direktur";
      }else if ($id == 2) {
        return "Pengajuan Diterima";
      }else if ($id == 3) {
        return "Pengajuan Sedang Diproses";
      }else if ($id == 4) {
        return "Menunggu Penerimaan oleh Gudang";
      }else if ($id == 5) {
        return "Belum Di Terima Oleh Gudang";
      }else if ($id == 6) {
        return "Sudah Diterima Oleh Gudang";
      }else if ($id == 7) {
        return "Pengajuan Selesai";
      }else if ($id == 8) {
        return "Pengajuan Dibatalkan Oleh Bag. Produksi";
      }else {
        return "Tidak Diketahui";
      }
    }
  function on() {
    document.getElementById("overlay").style.display = "block";
  }
  function off() {
    document.getElementById("overlay").style.display = "none";
  }
  function table(columns = [], row = [], id) {
    thead = [];
    tbody = [];
    for (var i = 0; i < columns.length; i++) {
      thead[i] = "<th>" + columns[i] + "</th>";
    }
    for (var i = 0; i < row.length; i++) {
      tr = [];
      td = [];
      tr[i] = "<tr>";
      for (var ia = 0; ia < row[i].length; ia++) {
        td[ia] = "<td>"+row[i][ia]+"</td>";
      }
      tr[i+1] = td.join("");
      tr[i+2] = "</tr>";
      tbody[i] = tr.join("");
    }
    cookingtable = [
      '<table class="table" id="' + id + '">',
      '<thead>',
      thead.join(""),
      '</thead>',
      '<tbody>',
      tbody.join(""),
      '</tbody>',
      '</table>'
    ];
    return cookingtable.join("");
  }
  function selectbuilder(data = [], obj, selected = []) {
    if (selected.length > 0) {
      console.log("Selected Detected");
      obj.append('<option value="' + selected[0].value + '" selected>' + selected[0].text + '</option>');
    }
    for (var i = 0; i < data.length; i++) {
      if (selected.length > 0) {
        if (data[i].value == selected[0].value) {
          continue;
        }
      }
      obj.append($("<option>", {
        value: data[i].value,
        text: data[i].text
      }));
    }
  }
  function konversi(rasio,jumlah,harga_bahan) {
      cCounter = jumlah*rasio;
      sub = harga_bahan * cCounter;
      return {"hasil":cCounter,"harga":(sub).toFixed(0)};
  }
  function konfirmasi($id)
   {
     if ($id == 0) {
       return "Belum Diverifikasi";
     }else if ($id == 1) {
       return "Sudah Diverifikasi";
     }else {
       return "Tidak Diketahui";
     }
   }

  function builder(inputs, button, id, button_del = true,col=1) {
      var colbuild = [];
      colindex = 0;
      colbuild[colindex++] = "<div class='col-md-12'>";
      construct_col = (12/col);
      if (col > 0) {
        console.log(construct_col);
        colbuild[colindex++] = "<div class='row'>";
        for (var ix = 0; ix < construct_col; ix++) {
          var input = inputs[ix];
          console.log("LOOP STRIKE " + ix);
          colbuild[colindex++] = "<div class='col-md-"+col+"'>";
          var inputboiler = [];
          for (var i = 0; i < input.length; i++) {
            if (input[i].value == undefined) {
              val = "";
            } else {
              val = input[i].value;
            }
            if (input[i].id == undefined) {
              ids = "";
            } else {
              ids = input[i].id;
            }
            if (input[i].step == undefined) {
              steps = "";
            } else {
              steps = "step='" + input[i].step + "'";
            }
            if (input[i].type == "select2") {
              temp = [
                '<div class="form-group">',
                '<label>' + input[i].label + '</label>',
                '<select class="form-control " id="' + ids + '" name="' + input[i].name + '" ' + steps + '></select>',
                '</div>'
              ];
            } else if (input[i].type == "hidden") {
              temp = [
                '<div class="form-group">',
                '<input type="text" hidden id="' + ids + '" value="' + val + '" name="' + input[i].name + '">',
                '</div>'
              ];
            } else if (input[i].type == "disabled") {
              temp = [
                '<div class="form-group">',
                '<label>' + input[i].label + '</label>',
                '<input type="text" class="form-control" disabled id="' + ids + '" value="' + val + '">',
                '</div>'
              ];
            } else if (input[i].type == "textarea") {
              temp = [
                '<div class="form-group">',
                '<label>' + input[i].label + '</label>',
                '<textarea class="form-control" id="' + ids + '" name="' + input[i].name + '" ' + steps + '>' + val + '</textarea>',
                '</div>'
              ];
            } else if (input[i].type == "readonly") {
              temp = [
                '<div class="form-group">',
                '<label>' + input[i].label + '</label>',
                '<input class="form-control" readonly type="' + input[i].type + '" id="' + ids + '" value="' + val + '" name="' + input[i].name + '" ' + steps + '>',
                '</div>'
              ];
            } else if (input[i].type == "password") {
              temp = [
                '<div class="form-group">',
                '<label>' + input[i].label + '</label>',
                '<input class="form-control"  type="' + input[i].type + '" id="' + ids + '" value="' + val + '" name="' + input[i].name + '" ' + steps + '>',
                '</div>'
              ];
            } else {
              temp = [
                '<div class="form-group">',
                '<label>' + input[i].label + '</label>',
                '<input class="form-control" type="' + input[i].type + '" id="' + ids + '" value="' + val + '" name="' + input[i].name + '" ' + steps + '>',
                '</div>'
              ];
            }
            inputboiler[i] = temp.join("");
          }
          indexinput = inputboiler.length;
          colbuild[colindex++] = inputboiler.join("");
          colbuild[colindex++] = "</div>";
        }
        colbuild[colindex++] = "</div>";
      }else{
        console.log("Wrong Col / Input");
        return false;
      }
      if (button != null) {
        buttontemp = [
          '<div class="form-group">',
          '<button class="btn btn-' + button.class + '" type="' + button.type + '">' + button.name + '</button>',
          '</div>'
        ];
      }
      buttondel = [];
      if (button_del != true) {
        buttondel = [
          '<div class="form-group">',
          '<button class="btn btn-' + button_del.class + '" id="' + button_del.id + '" data-id="' + button_del.data + '" type="' + button_del.type + '">' + button_del.name + '</button>',
          '</div>'
        ]
      }
      colbuild[colindex++] = "<div class='col-md-12'>";
      if (button != null) {
        colbuild[colindex++] = buttontemp.join("");
      }
      colbuild[colindex++] = buttondel.join("");
      colbuild[colindex++] = "</div>";
      colbuild[colindex++] = "</div>";
      cookinginput = colbuild.join("");
      cookingform = [
        '<form method="post" onsubmit="return false" id="' + id + '">',
        cookinginput,
        '</form>'
      ];
      return cookingform.join("");
    }
  require(['jquery','Pusher','sign','momentjs'], function ($,Pusher,SignaturePad,moment) {

      console.log("start");
    var momentNow = moment.unix("{{time()}}");
    $('#time_clock').html(momentNow.format('DD MMMM YYYY hh:mm:ss').toUpperCase());
    $("#sign").on('click', function(event) {
      event.preventDefault();
      var s = [
        "<div class=row>",
        "<div class=col-md-12>",
        "<canvas class='bg-gray' style='touch-action: none;' width='750px' height='350'>",
        "</canvas>",
        "</div>",
        "<div class=col-md-12>",
        "<button class='btn btn-large btn-primary m-2' id='set' type='button'>Simpan Tanda Tangan</button>",
        "<button class='btn btn-large btn-primary m-2' id='reset' type='button'>Reset Tanda Tangan</button>",
        "<input class='btn btn-large btn-primary m-2' type='file' id='frmData' />",
        "</div>",
        "</div>",
      ]
      ms = new jBox('Modal', {
        title: 'E-Signature',
        overlay: false,
        width: '800px',
        responsiveWidth:true,
        height: '800px',
        createOnInit: true,
        content: s.join(""),
        draggable: false,
        adjustPosition: true,
        adjustTracker: true,
        repositionOnOpen: false,
        offset: {
          x: 0,
          y: 0
        },
        repositionOnContent: false,
        onCloseComplete:function(){

        },
        onCreated:function(rs){
          j = this.content;
          console.log("Canvas");
          var canvas = document.querySelector("canvas");
          console.log(canvas);
          var signaturePad  = new SignaturePad(canvas,{
            penColor: "#000"
          });
          signaturePad.fromDataURL("{{session()->get("ttd")}}");
          j.find("#set").on('click', async function(event) {
            event.preventDefault();
            const data = signaturePad.toDataURL();
            const b64toBlob = (b64Data, contentType='', sliceSize=512) => {
              const byteCharacters = atob(b64Data);
              const byteArrays = [];

              for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                const slice = byteCharacters.slice(offset, offset + sliceSize);

                const byteNumbers = new Array(slice.length);
                for (let i = 0; i < slice.length; i++) {
                  byteNumbers[i] = slice.charCodeAt(i);
                }

                const byteArray = new Uint8Array(byteNumbers);
                byteArrays.push(byteArray);
              }

              const blob = new Blob(byteArrays, {type: contentType});
              return blob;
            }
            res = await $.post('{{route("upload_ttd")}}',{ttd:data}).then();
            if (res.status == 1) {
              new jBox('Notice', {content: "Sukses Upload Tanda Tangan",showCountdown:true, color: 'green'});
            }else {
              new jBox('Notice', {content: "Gagal Upload Tanda Tangan",showCountdown:true, color: 'red'});
            }
          });
          j.find("#reset").on('click', function(event) {
            event.preventDefault()
            signaturePad.clear();
          });
          j.find("#frmData").on('change',  function(event) {
            event.preventDefault();
            signaturePad.clear();
            const toBase64 = file => new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = error => reject(error);
            });

            async function Main(j,sig) {
               const file = document.querySelector('#frmData').files[0];
               d = await toBase64(file);
               sig.fromDataURL(d);
            }
            Main(j,signaturePad);
          });
        }
      });
      ms.open();
    });

    console.log(Pusher);
    $("#parent_bell").on('click', function(event) {
      event.preventDefault();
      $("#notif_class").attr('class', 'nav-read');
    });
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('801e58d55a5c9f23752b', {
      cluster: 'ap1',
      forceTLS: true
    });
    current = "{{session()->get("level")}}";
    var channel = pusher.subscribe('bell');
    channel.bind('notif', function(data)  {
      console.log(data);
      if (current == data.type) {
        new jBox('Notice', {content: 'Notifikasi Baru Diterima',showCountdown:true, color: 'blue'});
        $("#notif_class").attr('class', 'nav-unread');
        template = '<a href="'+data.link+'" class="dropdown-item d-flex"><div>'+data.message+'</div></a>';
        $("#notif_item").append(template);
      }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  });
  function onErr(img) {
    img.onerror = "";
    img.src = "{{url("notfound.png")}}";
    return true;
  }
  function number_format(nStr)
  {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
  }
  var sha256 = function sha256(ascii) {
	function rightRotate(value, amount) {
		return (value>>>amount) | (value<<(32 - amount));
	};

	var mathPow = Math.pow;
	var maxWord = mathPow(2, 32);
	var lengthProperty = 'length'
	var i, j; // Used as a counter across the whole file
	var result = ''

	var words = [];
	var asciiBitLength = ascii[lengthProperty]*8;

	//* caching results is optional - remove/add slash from front of this line to toggle
	// Initial hash value: first 32 bits of the fractional parts of the square roots of the first 8 primes
	// (we actually calculate the first 64, but extra values are just ignored)
	var hash = sha256.h = sha256.h || [];
	// Round constants: first 32 bits of the fractional parts of the cube roots of the first 64 primes
	var k = sha256.k = sha256.k || [];
	var primeCounter = k[lengthProperty];
	/*/
	var hash = [], k = [];
	var primeCounter = 0;
	//*/

	var isComposite = {};
	for (var candidate = 2; primeCounter < 64; candidate++) {
		if (!isComposite[candidate]) {
			for (i = 0; i < 313; i += candidate) {
				isComposite[i] = candidate;
			}
			hash[primeCounter] = (mathPow(candidate, .5)*maxWord)|0;
			k[primeCounter++] = (mathPow(candidate, 1/3)*maxWord)|0;
		}
	}

	ascii += '\x80' // Append Ƈ' bit (plus zero padding)
	while (ascii[lengthProperty]%64 - 56) ascii += '\x00' // More zero padding
	for (i = 0; i < ascii[lengthProperty]; i++) {
		j = ascii.charCodeAt(i);
		if (j>>8) return; // ASCII check: only accept characters in range 0-255
		words[i>>2] |= j << ((3 - i)%4)*8;
	}
	words[words[lengthProperty]] = ((asciiBitLength/maxWord)|0);
	words[words[lengthProperty]] = (asciiBitLength)

	// process each chunk
	for (j = 0; j < words[lengthProperty];) {
		var w = words.slice(j, j += 16); // The message is expanded into 64 words as part of the iteration
		var oldHash = hash;
		// This is now the undefinedworking hash", often labelled as variables a...g
		// (we have to truncate as well, otherwise extra entries at the end accumulate
		hash = hash.slice(0, 8);

		for (i = 0; i < 64; i++) {
			var i2 = i + j;
			// Expand the message into 64 words
			// Used below if
			var w15 = w[i - 15], w2 = w[i - 2];

			// Iterate
			var a = hash[0], e = hash[4];
			var temp1 = hash[7]
				+ (rightRotate(e, 6) ^ rightRotate(e, 11) ^ rightRotate(e, 25)) // S1
				+ ((e&hash[5])^((~e)&hash[6])) // ch
				+ k[i]
				// Expand the message schedule if needed
				+ (w[i] = (i < 16) ? w[i] : (
						w[i - 16]
						+ (rightRotate(w15, 7) ^ rightRotate(w15, 18) ^ (w15>>>3)) // s0
						+ w[i - 7]
						+ (rightRotate(w2, 17) ^ rightRotate(w2, 19) ^ (w2>>>10)) // s1
					)|0
				);
			// This is only used once, so *could* be moved below, but it only saves 4 bytes and makes things unreadble
			var temp2 = (rightRotate(a, 2) ^ rightRotate(a, 13) ^ rightRotate(a, 22)) // S0
				+ ((a&hash[1])^(a&hash[2])^(hash[1]&hash[2])); // maj

			hash = [(temp1 + temp2)|0].concat(hash); // We don't bother trimming off the extra ones, they're harmless as long as we're truncating when we do the slice()
			hash[4] = (hash[4] + temp1)|0;
		}

		for (i = 0; i < 8; i++) {
			hash[i] = (hash[i] + oldHash[i])|0;
		}
	}

	for (i = 0; i < 8; i++) {
		for (j = 3; j + 1; j--) {
			var b = (hash[i]>>(j*8))&255;
			result += ((b < 16) ? 0 : '') + b.toString(16);
		}
	}
	return result;
};
  </script>

  @stack("script")
</html>
