@include('admin.includes.head')
<style>
body>main>form>div>div>div.ck.ck-reset.ck-editor.ck-rounded-corners {
    width: 100%;
}
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<form method="POST" action="{{ route('update-article', ['id' => $article->id ])}}" autocomplete="off">
    @csrf
    @method('PATCH')
    <div class="container mt-4">
    <div class="row alert alert-danger alert-dismissible fade show" role="alert" id="error1" style="display: none;">
                
        </div> 
        <div class="row mb-2">
            <input class="form-control form-control-lg" type="text" name="title" value="{{$article->title}}"
                aria-label=".form-control-lg example">
        </div>
        <div class="row mb-2">
            <textarea id="editor" name="content"> {!! $article->content !!}</textarea>
            <script>
            ClassicEditor.create(document.querySelector('#editor'), {}).then(editor => {
                    
                    console.log(editor);
                }

            ).catch(error => {
                console.error(error);
            });
            </script>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
            <input type="file" id="file" class="form-control form-control-md" 
                name="featured_image">
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary btn-sm py-2" type="submit">Update</button>
            </div>
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
        let flag = false;

        values.forEach(element => {
            formD.append(element['name'], element['value']);
            if(element['name'] == "content" && element['value'].length > 0){
                flag = true;
            }
        });
        
        if(!flag){
            let errorElement = document.getElementById("error1");
            errorElement.innerHTML = "Please fill content";
            errorElement.style.display = "block";
            return false;
        }
        if(file){
            let base64Image = await toBase64(file);
            await formD.append("featured_image", await toBase64(file));
        }
        
        await $.ajax({
            url: "{{ route('update-article', ['id'=> $article->id])}}",
            data: formD,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(data) {
                if(data.hasOwnProperty("route")){
                    window.location.replace(data.route);    
                }
                
            }
        });
        
    }
});
</script>

@include('includes.footer')