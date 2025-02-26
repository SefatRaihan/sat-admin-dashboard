<div class="section-row">
    @if($name != null)
        @if (isset($checked) && $checked == 1)
            <label class="switch">
                <input type="hidden" class="value-of-checkbox" name="{{$name}}" value="1" /> <!-- to send a value event if the box is unchecked -->
                <input type="checkbox" class="check-toggle" value="1" checked>
                <span class="slider round"></span>
            </label>
        @else
            <label class="switch">
                <input type="hidden" class="value-of-checkbox" name="{{$name}}" value="0" />
                <input type="checkbox" class="check-toggle" value="1">
                <span class="slider round"></span>
            </label>
        @endif
    @else
        <span class="text-warning">Please Pass Name Attribute By Typing (name='your_name')</span>
    @endif
</div>

@push('css')
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 23px;
    }

    .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
    }

    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #2196F3;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
</style>
@endpush

@push('js')

    <script>
        (function($){
            $(document).ready(()=>{
                $(document).change(function(event){
                    let
                        el = event.target,
                        sectionRow = $(el).closest('.section-row');

                        if($(el).is(":checked")){
                            $(sectionRow).find('.value-of-checkbox').val(1);
                        }else{
                            $(sectionRow).find('.value-of-checkbox').val(0);
                        }
                });
                
            });
        })(jQuery)

    </script>
@endpush