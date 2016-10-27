<div class="fixed-action-btn" style="bottom: 35px; right: 24px;">
    <a class="btn-floating btn-large red btn modal-trigger waves-effect waves-light" id="add" data-target="new_post_modal">
        <i class="mdi mdi-plus"></i>
    </a>
</div>

<div id="new_post_modal" class="modal modal-fixed-footer">
    <form action="{{ route('vue.new.post') }}" method="post" enctype="multipart/form-data" id="newpostform">
        <div class="modal-content">
            <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat right"><span class="mdi mdi-close" style="position: relative; bottom: 7px"></span></button>
            <h4 class="black-text">Crie sua nova publicação!</h4>
            <div class="row">
                <div class="col s12 m12 l12 input-field">
                    <textarea style="line-height: 15px;" name="post_body" id="post_body" length="250" maxlength="250" class="materialize-textarea validate black-text" placeholder="Crie sua nova publicação"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <input type="file" name="post_image" id="post_image" hidden accept="image/*">
                    <div id="post_image_preview"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <label for="post_image" class="btn margin waves-effect left"><span class="mdi mdi-image-album" style="font-size: 16pt; position: relative; bottom: 10px"></span></label>
            <button type="submit" class="modal-action waves-effect waves-green btn green">Salvar</button>
            <button type="button" id="post_cancel" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</button>
        </div>
        {{ csrf_field() }}
    </form>
</div>

@section('script')
    <script>
        $(document).ready(function () {
            $('#newpostform').on('submit',function () {
                setTimeout(function () {
                            $('#post_cancel').trigger('click');
                        }
                , 200)
            });
        });
    </script>
@append