{{--失败提示--}}
<script>
    @if (session()->has('danger'))
    require(['hdjs'],function (hdjs) {
        hdjs.swal({
            text: "{{session()->get('danger')}}",
            button:false,
            icon:'warning'
        });
    });
    @endif
</script>
{{--成功提示--}}
{{--在看云里面的SweetAlert这个--}}
<script>
    @if (session()->has('success'))
    require(['hdjs'],function (hdjs) {
        hdjs.swal({
            text: "{{session()->get('success')}}",
            button:false,
            icon:'success'
        });
    });
    @endif
</script>
{{--手册在表单验证里面搜索errors--}}
<script>
    @if ($errors->any())
    require(['hdjs'], function (hdjs) {
        hdjs.swal({
            text: "@foreach ($errors->all() as $error) {{ $error }}\r\n @endforeach",
            button:false,
            icon:'warning'
        });
    });
    @endif
</script>
