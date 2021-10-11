@php 
    $h_ads = App\Models\Advertisement::where('end_date','>=',Carbon\Carbon::now())
        ->where('active',1)->where('display_method', 'horizontal')->pluck('id')->toArray();
    $v_ads = App\Models\Advertisement::where('end_date','>=',Carbon\Carbon::now())
        ->where('active',1)->where('display_method', 'vertical')->pluck('id')->toArray();
    $l_ads = App\Models\Advertisement::where('end_date','>=',Carbon\Carbon::now())
        ->where('active',1)->where('display_method', 'longitudinal')->pluck('id')->toArray();
@endphp

@if( auth()->user()->type != "super_admin" )
    <div class="e3lan-container">
        <div class="horizontal"><img class="img-fluid" @php if(count($h_ads) != 0){ $h_ad = App\Models\Advertisement::where('id',$h_ads[array_rand($h_ads)])->first(); echo 'src="'. asset($h_ad->image_path) .'"';} @endphp /></div>
        <div class="vertical-right"><img class="img-fluid" @php if(count($v_ads) != 0){ $v_ad = App\Models\Advertisement::where('id',$v_ads[array_rand($v_ads)])->first(); echo 'src="'. asset($v_ad->image_path) .'"';} @endphp /></div>
        <div class="vertical-left"><img class="img-fluid" @php if(count($l_ads) != 0){ $l_ad = App\Models\Advertisement::where('id',$l_ads[array_rand($l_ads)])->first(); echo 'src="'. asset($l_ad->image_path) .'"';} @endphp /></div>
    </div>
@endif