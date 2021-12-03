@section('title', 'Noticias')
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
            $('#modalFormDestroy').modal('hide');
        });


            $('#fechaNews').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: " / ",
                }
            }, function(start, end, label) {
                Livewire.emit('getAddFecha',  [start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD')]);
            });

        $('#fechaFilter').daterangepicker({
            opens: 'left',
            locale: {
                format: 'YYYY-MM-DD',
                separator: " / ",
            }
        }, function(start, end, label) {
            Livewire.emit('getFechaFilter',  start.format('YYYY-MM-DD')+'/'+end.format('YYYY-MM-DD'));
        });

        $('#fechaFilter').on('cancel.daterangepicker', function(ev, picker) {
            $('#fechaFilter').val('');
            Livewire.emit('getFechaFilter',  '');
        });

         $('#fechaNews').on('cancel.daterangepicker', function(ev, picker) {
                    $('#fechaFilter').val('');
                    Livewire.emit('getAddFecha',  '');
                });


            const editor = CKEDITOR.replace('editor1', {
                height: 150,
                modal:true,
                removeButtons: 'PasteFromWord'
            });

        window.addEventListener('text', event => {
            CKEDITOR.instances.editor1.setData( event.detail.text, function() { this.updateElement(); } )
        })

        editor.on('change', function (event) {
            Livewire.emit('getContenido',  editor.getData());
        })


    </script>
@endsection
