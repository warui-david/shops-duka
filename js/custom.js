$('.addbrand').click(function(e){
    e.preventDefault();
   $.get('addbrand',function(data){
        $('#addbrand').modal('show')
             .find('#addbrandContent')
             .html(data);
});
});
$('.addcolor').click(function(e){
     e.preventDefault();
    $.get('addcolor',function(data){
         $('#addcolor').modal('show')
              .find('#addcolorContent')
              .html(data);
 });
 });
 $('.adduom').click(function(e){
     e.preventDefault();
    $.get('adduom',function(data){
         $('#adduom').modal('show')
              .find('#adduomContent')
              .html(data);
 });
 });

 $('.addtocart').click(function(e){
	e.preventDefault();
	var productid = $(this).attr('productid');
	var userid = $(this).attr('userid');
	var baseUrl = $(this).attr('baseUrl');
	var quantity = $("#quantity_"+productid).val();
	
	$.ajax({
        url: baseUrl+"/product/addtocart?productid="+productid+"&userid="+userid+"&quantity="+quantity,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
            alert(res);
        }
    });
	
	alert(productid+' and '+userid+' and '+quantity);
 });
