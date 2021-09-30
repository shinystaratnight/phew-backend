<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>
    <div class="navbar-collapse collapse" id="navbar-footer">        
        <div class="navbar-text">
            @if(app()->getLocale() == 'ar')
                {{ settings('copy_write_ar') }} @ {{ date('Y') }}
            @else
                {{ settings('copy_write_en') }} @ {{ date('Y') }}
            @endif
        </div>
        <div class="navbar-nav ml-lg-auto">            
            {{-- {{ trans('dash.footer.developed_by') }} --}}
        </div>
    </div>
</div>
<!-- /footer -->