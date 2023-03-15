<script type="text/javascript">
$(function(){
	function trigger(e) {
	
	$("#mail").blur(function(){
			$.get("?ajax=mail_kontrol",{
				"mail" : $(this).val()
			},function(d){
				console.log(d.trim());
				if(d.trim()!=0) {
					alert("Bu mail adresi sistemde mevcuttur");
					$("#mail").focus();
				}
			});
		});
	$("[ajax_modal]").on("click",function(e){
		$("[ajax_modal]").off(); 
		
		var url = $(this).attr("href");
		$.get(url,function(d){
			$("#modal .modal-body").html(d);
			
				console.log(d);
				e.preventDefault();
				trigger(e);
			
			
		})
		$("#modal").modal();
		return false;
	});
	$("[teyit]").on("click",function(a){
			//$("[teyit]").off(); 
			var url = $(this).attr("href");
			var ajax = $(this).attr("ajax");
			var url2 = $(this).attr("href");
			var nesne = $(this).attr("ajax");
			$("#modal").modal();
			$("#modal .modal-footer").show();
			$("#modal .modal-body").html($(this).attr("teyit"));
			$("#modal #evet").attr("href",url);
			console.log("ok");
			$("#evet").click(function(){
				console.log(ajax);
				if(typeof(ajax)=="undefined") {
					console.log("ok");
					location.href=url;
				} else {
					$("#modal").modal('hide');
					$.get(url,function(d){
						console.log(d);
						$(nesne).hide();
					});
					return false;
				}
			});
			return false;
		});
		
	$("[ajax]:not([teyit])").click(function(){
		console.log("ok");
		var url = $(this).attr("href");
		var nesne = $(this).attr("ajax");
		//nesne.fadeTo(0.7);
		$.get(url,function(d){
			console.log(d);
			$(nesne).hide();
		});
		return false;
	});
	
	function alert(title) {
		$("#modal").modal();
		return false;
	}
	//$(".butonset").buttonset();
	$(".yayin").click(function(){
		var deger = $(this).attr("deger");
		var id = $(this).attr("id");
		if(deger ==1) {
			$(this).removeClass("btn-success");
			$(this).addClass("btn-danger");
			deger =0;
		} else {
			$(this).removeClass("btn-danger");
			$(this).addClass("btn-success");
			deger =1;
		}
		console.log(deger);
		$(this).attr("deger",deger);
		$.get("?yayin="+deger,{
			"id" : id
		},function(d){
			console.log(d);
		});
	});
	$(".drags").sortable({
					stop : function(e,u) {
						var k="";
						var dizi = new Array();
						$(".drags .drag").each(function(a){
								dizi.push([$(this).attr("id"),$(this).index()]);
						});
						console.log(dizi);
						$.post("?sira",{
								"dizi" : dizi	
						},function(d){
							console.log(d);
						});	
						
					}
				});
	$("#title").blur(function(){
		
		$.post("?slug",{
			deger : $(this).val()
		},function(d){
			
			$("#slug").val(d.trim());
		});
		
	});

	$("#slugguncelle").click(function(){
		
		$.post("?slug",{
			deger : $("#title2").val()
		},function(d){
			
			$("#slug2").val(d.trim());
		});
		
	});
	/*
	$(".autocomplete").autocomplete({
		source :"?autocomplete",
		minLength: 2
	});
	*/
	function imgerror(){
		$( "img" ).error(function() {
		//	$( this ).hide();
		});
	}
	function type_refresh(val) {
		$("#ozellikler").load("?ajax=ozellikler&id="+encodeURI(val));
	}
	//$(".googleSonuc").sortable();
	type_refresh($("#type").val());
	$("#type").change(function(){
		console.log("ok");
		type_refresh($(this).val());
		
	});
	
	} trigger();
});

</script>
