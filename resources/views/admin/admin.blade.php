@extends('admin.index')

@if(!empty($tiny))
@section('tiny')
    <script src="{{ asset('/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: "textarea.editor",
            themes: "modern",
            language: 'ru',
            branding: false,
            height: "{{ $areaH ?? 250 }}",
            width: "{{ $areaW ?? 712 }}",
            images_upload_base_path: "{{asset('/photos')}}",
            automatic_uploads: true,
            {{--content_css: "{{asset('css')}}/tinimce.css,",--}}
            importcss_file_filter: "{{asset('css')}}/tinimce.css",
            importcss_append: true,
            /*style_formats: [
                {
                    title: 'Шаблоны', items: [

                    {title: 'Две картинки', block: 'div', classes: 'images-block', exact: true, wrapper: 1},
                    {title: 'Одна большая картинка', block: 'div', classes: 'full-image', exact: true, wrapper: 1},
                    {title: 'Картинка слева', block: 'div', classes: 'left-image', exact: true, wrapper: 1},
                    {title: 'Картинка справа', block: 'div', classes: 'right-image', exact: true, wrapper: 1},
//                    {title: 'Заголовок H3', block: 'h3', classes: 'title-text', exact: true, wrapper: 1},
//                    {title: 'Цитата', block: 'blockquote'},
                ]
                },
            ],*/

            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern",
                "importcss"
            ],
            rel_list: [
                {title: 'follow', value: 'follow'},
                {title: 'nofollow', value: 'nofollow'}
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            relative_urls: false,
            file_browser_callback: function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endsection
@endif

@section('navbar')
    @isset($nav)
        <div class="navbar-header">
            {!! Menu::get('adminMenu')->asUl(array('class' => 'nav nav-pills')) !!}
        </div>
    @endisset
@endsection
@section('content')
    {!! $content !!}
@endsection

@section('jss')
    @isset($jss)
        {!! $jss !!}
    @endisset
@endsection
@section('css')
    @isset($css)
        {!! $css !!}
    @endisset
@endsection
