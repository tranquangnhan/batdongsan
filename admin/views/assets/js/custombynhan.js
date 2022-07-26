

// $(document).ready(function () {
   
 
//     var table = $('#key-table').DataTable(
//         {
//             "language": {
//                 "lengthMenu": "_MENU_",
//                 "zeroRecords": "Không có dữ liệu",
//                 "info": "Xem trang _PAGE_ / tổng _PAGES_",
//                 "infoEmpty": "Không có dữ liệu",
//                 "infoFiltered": "(filtered from _MAX_ total records)",
//                 "search": "Tìm Kiếm",
//                 "paginate": {
//                     "first": "Trang Đầu",
//                     "last": "Trang Cuối",
//                     "next": "Trang Sau",
//                     "previous": "Trang Trước"
//                 },
//             },
//             "ordering": false,
//             initComplete: function () {
//                 // Apply the search
//                 var that = this.api();
//                 $("#filter").click(function (e) { 
//                     e.preventDefault();
                 
//                     let quanhuyen = $( '#quanhuyen' ).val();
//                     let phuongxa = $( '#phuongxa' ).val();
//                     filterColumn(quanhuyen,phuongxa);

//                 });
//                 function filterColumn( value, value1 ) {
//                     that.column(3).search( value );
//                     that.column(4).search( value1 ).draw()
                  

//                     $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
//                         let left = parseInt($( '#left' ).val());
//                         let right = parseInt($( '#right' ).val());
                       
//                         let gia = 0;
//                         if(data[7].includes("tỷ")){
//                             gia = data[7].split(" ")[0];
//                         }
//                         return gia > left && gia < right ? true : false;
//                     });
                  
//                 }
//                 // that.search( this.value ).draw();
//                 // console.log(this.value)
//                 // this.api().columns().every( function () {
                  
               
//                 // } );
//             }
//         },
       
//     );
// });





// Pipelining function for DataTables. To be used to the `ajax` option of DataTables

$.fn.dataTable.pipeline = function (opts) {
    
  // Configuration options
  var conf = $.extend(
      {
          pages: 5, // number of pages to cache
          url: opts.url, // script url
          data: null, // function or object with parameters to send to the server
          // matching how `ajax.data` works in DataTables
          method: 'GET', // Ajax HTTP method
      },
      opts
  );
 

  // Private variables for storing the cache
  var cacheLower = -1;
  var cacheUpper = null;
  var cacheLastRequest = null;
  var cacheLastJson = null;

  return function (request, drawCallback, settings) {
      var ajax = false;
      var requestStart = request.start;
      var drawStart = request.start;
      var requestLength = request.length;
      var requestEnd = requestStart + requestLength;

      if (settings.clearCache) {
          // API requested that the cache be cleared
          ajax = true;
          settings.clearCache = false;
      } else if (cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper) {
          // outside cached data - need to make a request
          ajax = true;
      } else if (
          JSON.stringify(request.order) !== JSON.stringify(cacheLastRequest.order) ||
          JSON.stringify(request.columns) !== JSON.stringify(cacheLastRequest.columns) ||
          JSON.stringify(request.search) !== JSON.stringify(cacheLastRequest.search)
      ) {
          // properties changed (ordering, columns, searching)
          ajax = true;
      }

      // Store the request for checking next time around
      cacheLastRequest = $.extend(true, {}, request);

      if (ajax) {
          // Need data from the server
          if (requestStart < cacheLower) {
              requestStart = requestStart - requestLength * (conf.pages - 1);

              if (requestStart < 0) {
                  requestStart = 0;
              }
          }

          cacheLower = requestStart;
          cacheUpper = requestStart + requestLength * conf.pages;

          request.start = requestStart;
          request.length = requestLength * conf.pages;

          // Provide the same `data` options as DataTables.
          if (typeof conf.data === 'function') {
              // As a function it is executed with the data object as an arg
              // for manipulation. If an object is returned, it is used as the
              // data object to submit
              var d = conf.data(request);
              if (d) {
                  $.extend(request, d);
              }
          } else if ($.isPlainObject(conf.data)) {
              // As an object, the data given extends the default
              $.extend(request, conf.data);
          }

          return $.ajax({
              type: conf.method,
              url: conf.url,
              data: request,
              dataType: 'json',
              cache: false,
              success: function (json) {
                  
                  cacheLastJson = $.extend(true, {}, json);

                  if (cacheLower != drawStart) {
                      json.data.splice(0, drawStart - cacheLower);
                  }
                  if (requestLength >= -1) {
                      json.data.splice(requestLength, json.data.length);
                  }

                  drawCallback(json);
              },
          });
      } else {
          json = $.extend(true, {}, cacheLastJson);
          json.draw = request.draw; // Update the echo for each response
          json.data.splice(0, requestStart - cacheLower);
          json.data.splice(requestLength, json.data.length);

          drawCallback(json);
      }
  };
};

// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
// $.fn.dataTable.Api.register('clearPipeline()', function () {
//   return this.iterator('table', function (settings) {
//       settings.clearCache = true;
//   });
// });
// $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
//   let left = parseInt($( '#left' ).val());
//   let right = parseInt($( '#right' ).val());
  
//   let gia = 0;

//   console.log(data)
//   // if(data[7].includes("tỷ")){
//   //     gia = data[7].split(" ")[0];
//   // }
//   return gia > left && gia < right ? true : false;
// });

//
// DataTables initialisation
//
$(document).ready(function () {
  
 $('#quanhuyen').change(function (e) { 
    e.preventDefault();
      
      $.ajax({
        type: "POST",
        url: "?ctrl=baiviet&act=getxa",
        data: {id:e.target.value},
        dataType: "JSON",
        success: function (response) {
            let res = '';
            res += `<option value="" selected>Chọn Phường Xã</option>`;
            res += response.xa?.reduce((kq,item)=>{
                kq += `<option value="${item.name_xaphuong}">${item.name_xaphuong}</option>`;
                return kq;
            },'');

            $("#phuongxaajax").html(res);
        }
      });
  });   

  $('#key-table').DataTable({
      processing: false,
      serverSide: false,
      
      ajax: $.fn.dataTable.pipeline({
          url: '?ctrl=baiviet&act=getapi',
          pages: 1000, // number of pages to cache
        
      }),
      "language": {
          "lengthMenu": "_MENU_",
          "zeroRecords": "Không có dữ liệu",
          "info": "Xem trang _PAGE_ / tổng _PAGES_",
          "infoEmpty": "Không có dữ liệu",
          "infoFiltered": "(filtered from _MAX_ total records)",
          "search": "Tìm Kiếm",
          "paginate": {
              "first": "Trang Đầu",
              "last": "Trang Cuối",
              "next": "Trang Sau",
              "previous": "Trang Trước"
          },
      },
      initComplete: function () {
          // Apply the search
          var that = this.api();
        
  
          $("#filter").click(function (e) { 
            
              e.preventDefault();
            
              let tieude = $( '#tieude' ).val().toLowerCase();
              let quanhuyen = $( '#quanhuyen' ).find(':selected').attr('data-id')?.toLowerCase();
              let phuongxa = $( '#phuongxaajax' ).val();
              let dientich = $( '#locdientich' ).val();
              let sotang = $( '#sotang' ).val();
              let gia = $("#gia").val();
              let regexGia ='\\b(' + gia +')\\b';
              let regexDienTich ='\\b(' + dientich +')\\b';
              let regexQuanHuyen ='\\b(' + quanhuyen?.replace("quận ","") +')\\b';
            
              
                
              that.column(1).search(tieude);
              if(quanhuyen == undefined){
                that.column(2).search("");
              }else{
                that.column(2).search( regexQuanHuyen, true, false );
              }
              that.column(3).search(phuongxa);
              that.column(5).search( sotang )
              if(gia == undefined){
                that.column(7).search("");
              }else{
                that.column(7).search(regexGia, true, false);
              }
              if(dientich == undefined){
                that.column(8).search("");
              }else{
                that.column(8).search(regexDienTich, true, false).draw();
              }
             
                
          });
      
    
      }

  });
});

$(document).ready(function () {
    $(".hienloc").click(function (e) { 
        e.preventDefault();
        $(".filter").toggle();
    });
});