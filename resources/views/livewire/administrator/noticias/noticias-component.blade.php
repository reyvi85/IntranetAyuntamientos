@section('title', 'Noticias')
@section('css')
    <link href="{{ asset('css/daterangepicker.min.css') }}" rel="stylesheet">
    <style>
        .modal-open .ui-datepicker{z-index: 2000!important}
    </style>
    @endsection

<div class="col-12">
    @component('component.card')
        @slot('titulo')Noticias @endslot
        <div class="row">
            <div class="col-md-12">
               @include('livewire.administrator.noticias.listaNoticias')
            </div>
        </div>
    @endcomponent
</div>
@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script>
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalForm').modal('hide');
        });


            $('input[name="fechaNews"]').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: " / ",
                }
            }, function(start, end, label) {
                Livewire.emit('getAddFecha',  start.format('YYYY-MM-DD')+ ' / ' +end.format('YYYY-MM-DD'));
            });



        const editor = CKEDITOR.replace('editor1', {
            height: 150,
            removeButtons: 'PasteFromWord'
        });

        window.addEventListener('text', event => {
            CKEDITOR.instances.editor1.insertHtml('');
            CKEDITOR.instances.editor1.insertHtml(event.detail.text);
        })

        editor.on('change', function (event) {
            Livewire.emit('getContenido',  editor.getData());
        })


    </script>
@endsection
