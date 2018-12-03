<div class="card" id="app">
    <div class="card-body">

        <!-- Comments -->
        <div class="comment mb-3" v-for="v in comments" :id="'comment'+v.id">
            <div class="row">
                <div class="col-auto">

                    <!-- Avatar -->
                    <a class="avatar" href="">
                        <img :src="v.user.icon" alt="..." class="avatar-img rounded-circle">
                    </a>

                </div>
                <div class="col ml--2">

                    <!-- Body -->
                    <div class="comment-body">

                        <div class="row">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="comment-title">
                                    @{{v.user.name}}
                                </h5>

                            </div>
                            <div class="col-auto">

                                <!-- Time -->
                                <time class="comment-time">
                                    <a href="" @click.prevent="zan(v)">👍 @{{v.zan_num}} </a>
                                    |
                                    @{{v.created_at}}
                                </time>

                            </div>
                        </div>

                        <!-- Text -->
                        <p class="comment-text" v-html="v.content">
                        </p>

                    </div>

                </div>
            </div> <!-- / .row -->
        </div>


        <!-- Divider -->
        <hr>

        <!-- Form -->
        @auth()
            <div class="row align-items-start">
                <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar">
                        <img src="{{auth()->user()->icon}}" alt="..." class="avatar-img rounded-circle">
                    </div>

                </div>
                <div class="col ml--2">

                    <div id="editormd">
                        <textarea style="display:none;"></textarea>
                    </div>
                    <button class="btn btn-primary" @click.prevent="send()">发表评论</button>

                </div>
            </div> <!-- / .row -->
        @else
            <p class="text-muted text-center">请 <a href="{{route('user.login',['from'=>url()->full()])}}">登录</a> 后评论</p>
        @endauth
    </div>
    {{--@{{comment}}--}}
</div>
@push('js')
    {{--为什么要加auth，因为不加编辑器会报错 会不出来--}}

        <script>
            require(['hdjs', 'vue', 'axios', 'MarkdownIt', 'marked', 'highlight'], function (hdjs, Vue, axios, MarkdownIt, marked) {
                var vm = new Vue({
                    el: '#app',
                    data: {
                        comment: {content: ''},//当前评论数据
                        comments: [],//全部评论
                    },
                    updated(){
                        $(document).ready(function () {
                            $('pre code').each(function (i, block) {
                                hljs.highlightBlock(block);
                            });
                        });
                        //滚动页面
                        //alert(location.hash);
                        hdjs.scrollTo('body',location.hash,1000, {queue:true});
                    },
                    methods: {
                        //提交评论
                        @auth
                        send() {
                            //评论不能为空
                            if (this.comment.content.trim() == '') {
                                hdjs.swal({
                                    text: "评论内容呢？",
                                    button: false,
                                    icon: 'warning'
                                });
                                return false;
                            }
                            //axios也是ajax()
                            axios.post('{{route('index.comment.store')}}',{
                                content: this.comment.content,
                                article_id:'{{$article['id']}}',
                            }).then((response)=>{
                                //console.log(response.data.comment);
                                this.comments.push(response.data.comment);
                                //将markdown转换为html
                                let md = new MarkdownIt();
                                response.data.comment.content= md.render(response.data.comment.content);
                                //清空vue里面的所有数据
                                this.comment.content = '';
                                //清空编辑器里的所有内容
                                //选中所有内容
                                editormd.setSelection({line:0, ch:0}, {line:999999, ch:999999});
                                //将选中文本替换成空字符串
                                editormd.replaceSelection("");
                            })
                        },
                        //评论点赞
                        zan(v) {
                            let url = '/index/zan/like?type=comment&id='+v.id;
                            axios.get(url).then((response)=>{
                                //console.log(response.data.num);
                                v.zan_num = response.data.num;
                                //console.log(v.zan_num);
                            })
                        }
                        @endauth
                    },
                    mounted() {
                        //渲染编辑器
                        @auth
                        hdjs.editormd("editormd", {
                            width: '100%',
                            height: 300,
                            toolbarIcons: function () {
                                return [
                                    "undo", "redo", "|",
                                    "bold", "del", "italic", "quote", "|",
                                    "list-ul", "list-ol", "hr", "|",
                                    "link", "hdimage", "code-block", "|",
                                    "watch", "preview", "fullscreen"
                                ]
                            },
                            //后台上传地址，默认为hdjs配置项window.hdjs.uploader
                            server: '',
                            //editor.md库的位置
                            path: "{{asset('org/hdjs')}}/package/editor.md/lib/",
                            //监听编辑器的变化
                            onchange: function () {
                                //给vue对象中comment属性的content设置个值
                                vm.$set(vm.comment,'content',this.getValue());
                            }
                        });
                        @endauth
                        //请求当前文章的所有数据
                        axios.get('{{route('index.comment.index',['article'=>$article['id']])}}')
                            .then((response)=>{
                                  //console.log(response.data.comments);
                                this.comments = response.data.comments;
                                let md = new MarkdownIt();
                                  //console.log(this.comments);
                                this.comments.forEach((v)=>{
                                     v.content = md.render(v.content);
                                });
                            });
                    },
                });
            })
        </script>
@endpush