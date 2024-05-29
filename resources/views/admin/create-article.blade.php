@include('admin.includes.head')
<style>
body>main>form>div>div>div.ck.ck-reset.ck-editor.ck-rounded-corners {
    width: 100%;
}
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<form method="POST" action="{{ route('create-article')}}" autocomplete="off">
    @csrf
    <div class="container mt-4">
        <div class="row mb-2">
            <input class="form-control form-control-lg" type="text" name="title" placeholder="Title"
                aria-label=".form-control-lg example">
        </div>
        <div class="row mb-2">
            <textarea id="editor" name="content"> </textarea>
            <script>
            ClassicEditor.create(document.querySelector('#editor'), {}).then(editor => {
                    window.editor = editor;
                    const imageBtn = document.querySelector('.ck-file-dialog-button');
                    if (!imageBtn) return;
                    let imageIcon = imageBtn.querySelector('svg.ck-icon');
                    imageIcon.style.width = 'var(--ck-icon-size)';
                    const dropdownBtn = document.querySelector('button.ck-splitbutton__arrow');
                    let downAngleIcon = dropdownBtn.querySelector('svg.ck-icon');
                    imageBtn.style.display = 'none';
                    downAngleIcon.remove()
                    dropdownBtn.prepend(imageIcon);
                }

            ).catch(error => {
                console.error(error);
            });
            </script>
        </div>
        <div class="row mb-3">
            <input type="file" id="file" class="form-control form-control-lg" aria-label="Large file input example"
                name="featured_image">
        </div>
        <div class="row">
            <button class="btn btn-primary py-2" type="submit">Create</button>
        </div>
    </div>

</form>

<script>
$("form").submit(function(e) {
    e.preventDefault();
    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = reject;
    });
    main($(this));
    async function main(form) {
        const file = document.querySelector('#file').files[0];
        let values = form.serializeArray();
        let formD = new FormData();
        values.forEach(element => {
            formD.append(element['name'], element['value'])
        });

        let base64Image = await toBase64(file);

        await formD.append("featured_image", await toBase64(file));
        await $.ajax({
            url: "{{ route('create-article')}}",
            data: formD,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(data) {
                if('route' in data){
                    window.location.replace(data.route);
                }
            }
        });
    }
});
</script>

@include('includes.footer')