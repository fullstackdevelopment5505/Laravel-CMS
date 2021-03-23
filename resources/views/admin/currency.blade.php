@extends('admin.layout.app')
@section('content')
<div>
    @include('admin.layout.sidebar')
    <div class="all-content-wrapper">
        @include('admin.layout.header')
        <div class="traffic-analysis-area">
            <div class="container-fluid">
                <div class="sparkline13-list">
                <div class="header-panel">
                    <div class="sparkline13-hd">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="main-sparkline13-hd">
                                    <h1>Currency</h1>
                                </div>
                            </div>
                            <div class="col-md-3 m-b-15 text-right">
                                <a href="<?php echo asset('/').'textla/dashboard'?>"
                                    class="btn btn-primary btn-sm">Home</a>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="header-panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('status') }}                               
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('error') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">                    
                        <div class="col-md-6">
                        <h3>Currency Selected: <span class="label label-success"><?php if($currency!=''){echo $currency;}?> </span>                              
                        </h3> 
                        <h4>Type : <span class="label label-success"><?php if($currencyType=='1'){echo 'With Decimal';}else{echo 'Without Decimal';}?> </span></h4>
                        <br>             
                            <div class="form-group">                                
                                <label class="radio-inline"><input type="radio" value="1" name="optvalue" <?php if($currencyType=='1'){echo 'checked';}?>>With Decimal</label>
                                <label class="radio-inline"><input type="radio" value="0" name="optvalue" <?php if($currencyType=='0'){echo 'checked';}?>>Without decimal</label>
                                </div>
                                <div class="form-group"> 
                                <select name="curr_currency" id="curr_currency" class="form-control">
                                    <option value="$" <?php if($currency=='$'){echo 'selected';}?>>United States Dollars</option>
                                    <option value="€" <?php if($currency=='€'){echo 'selected';}?>>Euro</option>
                                    <option value="£" <?php if($currency=='£'){echo 'selected';}?>>United Kingdom Pounds</option>
                                    <option value="AR$" <?php if($currency=='AR$'){echo 'selected';}?>>Argentina Pesos</option>
                                    <option value="AU$" <?php if($currency=='AU$'){echo 'selected';}?>>Australia Dollars</option>
                                    <option value="BEF" <?php if($currency=='BEF'){echo 'selected';}?>>Belgium Francs</option>
                                    <option value="BMD" <?php if($currency=='BMD'){echo 'selected';}?>>Bermuda Dollars</option>
                                    <option value="R$" <?php if($currency=='R$'){echo 'selected';}?>>Brazil Real</option>
                                    <option value="BGL" <?php if($currency=='BGL'){echo 'selected';}?>>Bulgaria Lev</option>
                                    <option value="CA$" <?php if($currency=='CA$'){echo 'selected';}?>>Canada Dollars</option>
                                    <option value="CL$" <?php if($currency=='CL$'){echo 'selected';}?>>Chile Pesos</option>
                                    <option value="CN¥" <?php if($currency=='CN¥'){echo 'selected';}?>>China Yuan Renmimbi</option>
                                    <option value="CYP" <?php if($currency=='CYP'){echo 'selected';}?>>Cyprus Pounds</option>
                                    <option value="Kč" <?php if($currency=='Kč'){echo 'selected';}?>>Czech Republic Koruna</option>
                                    <option value="Dkr" <?php if($currency=='Dkr'){echo 'selected';}?>>Denmark Kroner</option>
                                    <option value="NLG" <?php if($currency=='NLG'){echo 'selected';}?>>Dutch Guilders</option>
                                    <option value="XCD" <?php if($currency=='XCD'){echo 'selected';}?>>Eastern Caribbean Dollars</option>
                                    <option value="EGP" <?php if($currency=='EGP'){echo 'selected';}?>>Egypt Pounds</option>
                                    <option value="FJD" <?php if($currency=='FJD'){echo 'selected';}?>>Fiji Dollars</option>
                                    <option value="FIM" <?php if($currency=='FIM'){echo 'selected';}?>>Finland Markka</option>
                                    <option value="FRF" <?php if($currency=='FRF'){echo 'selected';}?>>France Francs</option>
                                    <option value="DEM" <?php if($currency=='DEM'){echo 'selected';}?>>Germany Deutsche Marks</option>
                                    <option value="XAU" <?php if($currency=='XAU'){echo 'selected';}?>>Gold Ounces</option>
                                    <option value="GRD" <?php if($currency=='GRD'){echo 'selected';}?>>Greece Drachmas</option>
                                    <option value="HK$" <?php if($currency=='HK$'){echo 'selected';}?>>Hong Kong Dollars</option>
                                    <option value="HUF" <?php if($currency=='HUF'){echo 'selected';}?>>Hungary Forint</option>
                                    <option value="Ikr" <?php if($currency=='Ikr'){echo 'selected';}?>>Iceland Krona</option>
                                    <option value="₹" <?php if($currency=='₹'){echo 'selected';}?>>India Rupees</option>
                                    <option value="Rp" <?php if($currency=='Rp'){echo 'selected';}?>>Indonesia Rupiah</option>
                                    <option value="IEP" <?php if($currency=='IEP'){echo 'selected';}?>>Ireland Punt</option>
                                    <option value="₪" <?php if($currency=='ILS'){echo 'selected';}?>>Israel New Shekels</option>
                                    <option value="ITL" <?php if($currency=='ITL'){echo 'selected';}?>>Italy Lira</option>
                                    <option value="JMD" <?php if($currency=='JMD'){echo 'selected';}?>>Jamaica Dollars</option>
                                    <option value="¥" <?php if($currency=='¥'){echo 'selected';}?>>Japan Yen</option>
                                    <option value="JD" <?php if($currency=='JD'){echo 'selected';}?>>Jordan Dinar</option>
                                    <option value="₩" <?php if($currency=='₩'){echo 'selected';}?>>Korea (South) Won</option>
                                    <option value="LB£" <?php if($currency=='LB£'){echo 'selected';}?>>Lebanon Pounds</option>
                                    <option value="LUF" <?php if($currency=='LUF'){echo 'selected';}?>>Luxembourg Francs</option>
                                    <option value="RM" <?php if($currency=='RM'){echo 'selected';}?>>Malaysia Ringgit</option>
                                    <option value="MXP" <?php if($currency=='MXP'){echo 'selected';}?>>Mexico Pesos</option>
                                    <option value="NLG" <?php if($currency=='NLG'){echo 'selected';}?>>Netherlands Guilders</option>
                                    <option value="NZ$" <?php if($currency=='NZ$'){echo 'selected';}?>>New Zealand Dollars</option>
                                    <option value="Nkr" <?php if($currency=='Nkr'){echo 'selected';}?>>Norway Kroner</option>
                                    <option value="₨" <?php if($currency=='₨'){echo 'selected';}?>>Pakistan Rupees</option>
                                    <option value="XPD" <?php if($currency=='XPD'){echo 'selected';}?>>Palladium Ounces</option>
                                    <option value="₱" <?php if($currency=='₱'){echo 'selected';}?>>Philippines Pesos</option>
                                    <option value="XPT" <?php if($currency=='XPT'){echo 'selected';}?>>Platinum Ounces</option>
                                    <option value="PLZ" <?php if($currency=='PLZ'){echo 'selected';}?>>Poland Zloty</option>
                                    <option value="PTE" <?php if($currency=='PTE'){echo 'selected';}?>>Portugal Escudo</option>
                                    <option value="ROL" <?php if($currency=='ROL'){echo 'selected';}?>>Romania Leu</option>
                                    <option value="RUR" <?php if($currency=='RUR'){echo 'selected';}?>>Russia Rubles</option>
                                    <option value="SR" <?php if($currency=='SR'){echo 'selected';}?>>Saudi Arabia Riyal</option>
                                    <option value="XAG" <?php if($currency=='XAG'){echo 'selected';}?>>Silver Ounces</option>
                                    <option value="S$" <?php if($currency=='S$'){echo 'selected';}?>>Singapore Dollars</option>
                                    <option value="SKK" <?php if($currency=='SKK'){echo 'selected';}?>>Slovakia Koruna</option>
                                    <option value="R" <?php if($currency=='R'){echo 'selected';}?>>South Africa Rand</option>
                                    <option value="KRW" <?php if($currency=='KRW'){echo 'selected';}?>>South Korea Won</option>
                                    <option value="ESP" <?php if($currency=='ESP'){echo 'selected';}?>>Spain Pesetas</option>
                                    <option value="XDR" <?php if($currency=='XDR'){echo 'selected';}?>>Special Drawing Right (IMF)</option>
                                    <option value="SDD" <?php if($currency=='SDD'){echo 'selected';}?>>Sudan Dinar</option>
                                    <option value="Skr" <?php if($currency=='Skr'){echo 'selected';}?>>Sweden Krona</option>
                                    <option value="CHF" <?php if($currency=='CHF'){echo 'selected';}?>>Switzerland Francs</option>
                                    <option value="NT$" <?php if($currency=='NT$'){echo 'selected';}?>>Taiwan Dollars</option>
                                    <option value="฿" <?php if($currency=='฿'){echo 'selected';}?>>Thailand Baht</option>
                                    <option value="TT$" <?php if($currency=='TT$'){echo 'selected';}?>>Trinidad and Tobago Dollars</option>
                                    <option value="TRL" <?php if($currency=='TRL'){echo 'selected';}?>>Turkey Lira</option>
                                    <option value="VEB" <?php if($currency=='VEB'){echo 'selected';}?>>Venezuela Bolivar</option>
                                    <option value="ZK" <?php if($currency=='ZK'){echo 'selected';}?>>Zambia Kwacha</option>                               
                                </select>
                                <br>
                                <button type="submit" class="btn btn-primary" id="btncurrency"> Set Currency</button>

                            </div>

                        </div>
                    </div>
                 </div>

                    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
                    <script>
                    
                        function fetch_data(cur_value,cur_type) {                                                    
                            $.ajax({
                                url: "<?php echo asset('/').'textla/currency/setCurrency?currency='?>" + cur_value + "&currencyType=" + cur_type,
                                success: function(data) {
                                    console.log(data);          
                                    location.reload(true);  
                                }
                            })
                        }

                        // $( "#curr_currency" ).change(function() {
                        //    var data = $( "select option:selected" ).val();                            
                        //     fetch_data(data);
                        // });                                            
                        $( "#btncurrency" ).click(function() {
                            $(this).text('please wait...')
                           var cur_value = $( "select option:selected" ).val();                            
                           var cur_type = $('input[name=optvalue]:radio:checked').val(); 
                            fetch_data(cur_value,cur_type);
                        });                                            
                       
                   
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection