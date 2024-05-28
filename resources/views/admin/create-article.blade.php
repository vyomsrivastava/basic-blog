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
            <input class="form-control form-control-lg" type="text" name="title" placeholder="Title" aria-label=".form-control-lg example">
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
                }
            );
            </script>
        </div>
        <div>
            <button class="btn btn-primary py-2" type="submit">Create</button>
        </div>
    </div>
    
</form>
<script>
    $("form").submit(function(e){
            e.preventDefault();
            var values = $(this).serializeArray();

            
            console.log(datas);
            var data = new FormData();
            var datas = {};
            values.forEach(element => {
                datas[element['name']] = element['value'].replace(/<[^>]+>/g, '');
                data.append(element['name'],element['value'])
            });
            $.ajax({
                url: "{{ route('create-article')}}" ,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                success: function(data){
                    alert(data);
                }
            });
    });
</script>
@include('includes.footer')