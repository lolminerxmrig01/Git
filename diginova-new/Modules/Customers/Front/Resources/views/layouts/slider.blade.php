@if ($item->images->count() == 2)
  @if (!is_null($item) && $item->images()->exists())
    <aside class="c-adplacement">
      @foreach ($item->images as $image)
       @if ($image->media()->exists())
        <a href="{{ $image->media()->exists() ? $image->link : '' }}"
            class="js-banner-impression-adro c-adplacement__item c-adplacement__item--b"
            data-observed="0" target="_blank"
            title="{{ $image->media()->exists() ? $image->alt : '' }}" data-is-trackable="">
          <div class="c-adplacement__sponsored_box">
            <img src="{{ full_media_path($image->media->first()) }}"
                  alt="{{ $image->media()->exists() ? $image->alt : '' }}" loading="lazy" />
          </div>
        </a>
       @endif
      @endforeach
    </aside>
  @endif
@endif

@if ($item->images->count() == 4)
  @if (!is_null($item) && $item->images()->exists())
    <aside class="c-about-digikala-items">
      <aside class="c-adplacement c-adplacement__container-row">
          @foreach ($item->images as $image)
            @if ($image->media()->exists())
            <a href="{{ $image->media()->exists() ? $image->link : '' }}"
              class="c-adplacement__item js-banner-impression-adro" data-observed="1" target="_blank"
              data-is-trackable="" title="{{ $image->media()->exists() ? $image->alt : '' }}">
             <div class="c-adplacement__sponsored_box">
               <img src="{{ full_media_path($image->media->first()) }}"
                    alt="{{ $image->media()->exists() ? $image->alt : '' }}" loading="lazy">
             </div>
           </a>
            @endif
          @endforeach
      </aside>
    </aside>
  @endif
@endif

@if ($item->images->count() == 1)
  @if (!is_null($item) && $item->images()->exists() && $item->images()->first()->media()->exists())
    @if ($image->media()->exists())
      <aside class="c-adplacement c-adplacement--main-page-inner c-adplacement__container-row">
          <a href="{{ $item->images()->first()->link }}"
            class="c-adplacement__item js-banner-impression-adro" data-observed="0" target="_blank"
            data-is-trackable="" title="{{ $item->images()->first()->alt }}">
            <div class="c-adplacement__sponsored_box">
              <img src="{{ $item->images()->first()->media()->exists()
                      ? full_media_path($item->images()->first()->media->first())
                      : ''
                    }}"
                  alt="{{ $item->images()->first()->media()->exists()
                      ? $item->images()->first()->alt
                      : ''
                    }}"
                  loading="lazy" />
            </div>
          </a>
      </aside>
    @endif
  @endif
@endif
