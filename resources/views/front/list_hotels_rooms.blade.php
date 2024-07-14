@extends('../layouts.frontend')
@section('title')
Rooms Hotel
@endsection
@section('content')
<section id    = "content" class = "max-w-[640px] w-full min-h-screen mx-auto flex flex-col bg-[#F8F8F8] overflow-x-hidden pb-[122px] relative">
<div     class = "w-full h-[165px] absolute top-0 bg-[linear-gradient(244.6deg,_#7545FB_14.17%,_#2A3FCC_92.43%)]">
    </div>
    <div class="relative z-10 px-[18px] flex flex-col gap-6 mt-[60px]">
      <div class="flex items-center justify-between top-menu">
        <a href="{{route('front.hotels.details', $hotel)}}" class="">
          <div class="w-[42px] h-[42px] flex shrink-0">
            <img src="{{asset('')}}frontend/assets/images/icons/back.svg" alt="icon">
          </div>
        </a>
        <p class="font-semibold text-lg leading-[28px] text-white text-center">Select Room Type</span></p>
        <div class="dummy-spacer w-[42px] h-[42px] flex shrink-0">
        </div>
      </div>
      <div id = "result" class = "result-card-container flex flex-col gap-[18px]">
        @forelse ($hotelrooms as $item)
          <div class = "flex flex-col overflow-hidden bg-white card-result rounded-xl">
          <div class = "thumbnail-container w-full aspect-[357/160] overflow-hidden flex shrink-0">
          <img src   = "{{asset('')}}uploads/{{$item->photo}}" class = "object-cover w-full h-full" alt = "thumbnail">
          </div>
          <div class="flex flex-col gap-4 p-4 content-container">
            <div class="title-container flex flex-col gap-[2px]">
              <p class="font-semibold">{{$item->name}}</p>
              <p class="font-medium text-sm leading-[21px] text-[#757C98]">Max.{{$item->total_people}} Adult /Room</p>
            </div>
            <div class="facilities-container rounded-xl border border-[#DCDFE6] overflow-hidden">
              <div class="flex flex-col gap-4 p-4 pb-0 mb-4">
                <div class="flex items-center gap-1">
                  <div class="flex shrink-0">
                    <img src="{{asset('')}}frontend/assets/images/icons/wifi-square-grey.svg" alt="icon">
                  </div>
                  <p class="font-medium text-sm leading-[21px] text-[#757C98]">Free Wi-Fi</p>
                </div>
                <div class="flex items-center gap-1">
                  <div class="flex shrink-0">
                    <img src="{{asset('')}}frontend/assets/images/icons/coffee-grey.svg" alt="icon">
                  </div>
                  <p class="font-medium text-sm leading-[21px] text-[#757C98]">Coffee & Tea</p>
                </div>
                <div class="flex items-center gap-1">
                  <div class="flex shrink-0">
                    <img src="{{asset('')}}frontend/assets/images/icons/wind-grey.svg" alt="icon">
                  </div>
                  <p class="font-medium text-sm leading-[21px] text-[#757C98]">Air Conditions</p>
                </div>
              </div>
              <div class="w-full bg-[#F93F6C] p-[10px]">
                <p class="text-center font-semibold text-xs leading-[18px] text-white">Refund & Reschedule not allowed</p>
              </div>
            </div>
            <div class="flex items-center justify-between price-container">
              <div class="total-price flex flex-col gap-[2px]">
                <p class="text-[#54A917] font-semibold text-lg leading-[27px]">Rp {{number_format($item->price, 0, ',', '.')}}</p>
                <p class="text-[#757C98] font-semibold text-xs leading-[18px]">/night</p>
              </div>
              <form method="POST" action="{{route('front.hotels.room.book', [$hotel->slug, $item->id])}}" enctype="multipart/form-data">
                  @csrf
                  <button type="submit"  class="w-[138px] h-[48px] bg-[#4041DA] p-[12px_24px] rounded-full text-nowrap text-white font-semibold text-sm leading-[21px] flex items-center justify-center">Choose</button>
              </form>
            </div>
          </div>
        </div>
        @empty

        @endforelse


      </div>
    </div>
  </section>
@endsection
