

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
          console.log(request)
          return $.ajax({
              type: conf.method,
              url: conf.url,
              data: request,
              dataType: 'json',
              cache: false,
              success: function (json) {
                  console.log(json)
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

$(document).ready(function () {
 
 $('#quanhuyen').change(function (e) { 
    e.preventDefault();
    getPhuongXa($('#quanhuyen').find(":selected").attr('data-id'))
  });
  $('#phuongxaajax').change(function (e) { 
    e.preventDefault();
    getDuong($('#phuongxaajax').find(":selected").attr('data-id'))
  });      

  function getPhuongXa(idQuanHuyen){
    $.ajax({
        type: "POST",
        url: "?ctrl=baiviet&act=getxa",
        data: {id:idQuanHuyen},
        dataType: "JSON",
        success: function (response) {
            let phuongXaHidden = $("#phuongxahidden").val();

            let res = '';
            res += `<option value="" selected>Chọn Phường Xã</option>`;
            res += response.xa?.reduce((kq,item)=>{
                if(phuongXaHidden != '' && phuongXaHidden?.toLowerCase()?.trim() == item?.ten_phuong?.toLowerCase()?.trim()){
                    kq += `<option selected data-id="${item.id_phuong}" value="${item.ten_phuong}">${item.ten_phuong}</option>`;
                }
                else{
                    kq += `<option data-id="${item.id_phuong}" value="${item.ten_phuong}">${item.ten_phuong}</option>`;
                }
                return kq;
            },'');

            $("#phuongxaajax").html(res);

            if($('#phuongxaajax').find(":selected").attr('data-id') != ''){
                getDuong($('#phuongxaajax').find(":selected").attr('data-id'))
            }
        }
      });
    }

  //function thực hiện code khi đã có quận huyện   
  ( ()=>{
    if($("#quanhuyen").find(":selected").attr('data-id') != ''){
        getPhuongXa($("#quanhuyen").find(":selected").attr('data-id'));
     
   }
  })();

  

  function getDuong(idPhuongXa){
    console.log(idPhuongXa)
    $.ajax({
        type: "POST",
        url: "?ctrl=baiviet&act=getduong",
        data: {id:idPhuongXa},
        dataType: "JSON",
        success: function (response) {
            let duongHidden = $("#duonghidden").val();

            let res = '';
            res += `<option value="" selected>Chọn đường</option>`;
            res += response.duong?.reduce((kq,item)=>{
                if(duongHidden != '' && duongHidden?.toLowerCase()?.trim() == item?.ten_duong?.toLowerCase()?.trim()){
                    kq += `<option selected value="${item.ten_duong}">${item.ten_duong}</option>`;
                }else{
                    kq += `<option value="${item.ten_duong}">${item.ten_duong}</option>`;
                }
                return kq;
            },'');

            $("#duongajax").html(res);
        }
      });
    }


 

  
 

  $('#key-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: $.fn.dataTable.pipeline({
          url: '?ctrl=baiviet&act=getapi',
          pages: 1000, // number of pages to cache,
      }),
      order: [[13, 'desc']],
      "ordering":"true",
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
              let quanhuyen = $( '#quanhuyen' ).val();
              let phuongxa = $( '#phuongxaajax' ).val();
              let duong = $( '#duongajax' ).val();
              let dientich = $( '#locdientich' ).val();
              let sotang = $( '#sotang' ).val();
              let nguon = $( '#nguon' ).val();
              let gia = $("#gia").val();
              let loai = $("#loai").val();
              let huong = $("#huong").val();
              let regexGia ='\\b(' + gia +')\\b';
              let regexDienTich ='\\b(' + dientich +')\\b';
              let regexQuanHuyen ='\\b(' + quanhuyen +')\\b';
              let regexPhuongXa ='\\b(' + phuongxa +')\\b';
              let regexDuong ='\\b(' + duong +')\\b';
              
                
              that.column(1).search(tieude)
              if(!quanhuyen){
                that.column(2).search("")
              }else{
                that.column(2).search( regexQuanHuyen, true, true )
              }
              
              if(!phuongxa){
                that.column(3).search("")
              }else{
               
                that.column(3).search(regexPhuongXa, true, false )
              }
              if(!duong){
                that.column(4).search("")
              }else{
                that.column(4).search(regexDuong, true, false )
              }


              that.column(6).search( sotang )
         
              if(gia == ""){
                that.column(8).search("")
              }else{
                that.column(8).search(regexGia, true, false)
              }
   

            if(dientich == ""){
                that.column(9).search("")
            }else{
                that.column(9).search(regexDienTich,true,false)
            }
            that.column(10).search(nguon, false, false)
            that.column(15).search(loai, false, false)
            that.column(16).search(huong, false, false).draw();
            
                
          });
      
    
      }

  });
});



 

$(document).ready(function () {
    // check is mobile
    function mobileCheck() {
        let check = false;
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    };

    $(".hienloc").click(function (e) { 
        e.preventDefault();
        $(".filter").toggle();
    });
    if(mobileCheck()){
        $("#filter").click(
            function (e) { 
                e.preventDefault();
                $(".filter").slideToggle( "slow" );
            }
        );
    }
   

});





$('.carousel').carousel('pause')
