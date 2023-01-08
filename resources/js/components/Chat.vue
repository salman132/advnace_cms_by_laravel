<template>
    <div class="chat-view">
        <div class="card">
            <div class="card-header">
                <div class="container card-title">
                    Ticket Supports

                </div>
            </div>

            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h3>Recent Chat</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="chat-list" v-chat-scroll>

                            <li class="chat-item" v-for="msg in messages">
                                <div class="profile-image">
                                    <div class="chat-img" v-if="checkImage(msg.user.profile_pic)"><img :src="msg.user.profile_pic" alt="user"></div>
                                    <div class="chat-img" v-else><img :src="asset+msg.user.profile_pic" alt="user"></div>
                                </div>
                                <div class="profile-name">
                                    <h6 class="font-medium"><a href="#" target="_blank" class="text-success">{{ msg.user.name }}</a></h6>

                                </div>
                                <div class="chat-content">


                                    <div class="box bg-light-info">
                                        {{ msg.message }}
                                        <div class="chat-time">{{ moment(msg.created_at).fromNow() }}</div>

                                    </div>


                                    <br>
                                    <div class="box bg-light-info" v-if="msg.attachments">
                                        <a target="_blank" :href="asset+msg.attachments" class="ik ik-paperclip text-success">Attachments</a>
                                    </div>

                                </div>

                            </li>



                        </ul>
                    </div>
                    <div class="card-footer chat-footer">

                        <div class="input-wrap">
                            <form @submit.prevent="addMsg">

                                <div class="row">
                                    <div class="col-md-10 col-sm-10 col-12">
                                        <div class="text-area">
                                            <input type="text" placeholder="Type and enter"  class="form-control" name="text" v-model="text">
                                        </div>

                                        <div class="attach-area">
                                            <label for="file" class="custom-file-upload">
                                                <i class="ik ik-paperclip" data-slider-tooltip="file"></i>
                                            </label>
                                            <input id="file" name="file" ref="file" v-on:change="fileUpload()" type="file"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-2">

                                        <div class="form-group cus-send">
                                            <button type="submit" class="btn btn-icon btn-theme"><i class="fa fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        name: 'Chat',
        props: ['chatRoute', 'requestRoot','myUser','postRoute'],
        data() {
            return {
                messages: [],
                text: null,
                asset: this.requestRoot+"/",
                file:null,
                moment:moment
            }
        },
        created() {
            this.fetchMsg()
        },
        methods: {
            fetchMsg: function () {
                let url = this.chatRoute;
                axios.get(url).then(response => {
                    this.messages = response.data
                }).catch(error => {
                    console.log(error);
                })




            },
            addMsg(){
                if(this.text){
                    let formData = new FormData();
                    formData.append('file', this.file);
                    let text = this.text;
                    this.text = null;
                    formData.append('text',text);
                    let url = this.postRoute;
                    axios.post(url,formData,{
                        headers:{
                            'Content-Type' : 'multipart/form-data'
                        }

                    }).then(()=>{
                        this.text = null;
                        this.fetchMsg()
                    }).catch(error =>{
                        console.log(error)
                    })

                }
            },
            fileUpload:function(){
                this.file = this.$refs.file.files[0]


            },
            checkImage(img){
                let re = new RegExp("^(http|https)://", "i");
                re= re.test(img);
                return re;
            }
        }
    }
</script>


<style>
    .chat-list{
        min-height: 300px;
        max-height: 300px;
        overflow:auto;
    }
    .chat-list::-webkit-scrollbar{
        width: 3px;
    }
    .chat-list::-webkit-scrollbar-track{
        background: #aaa;
    }
    .chat-list::-webkit-scrollbar-thumb{
        background-color:#000036 !important;
    }
    ul li{
        list-style: none;
        padding: 20px 0;
    }
    .chat-list ul{
        padding: 0;
        list-style: none;
    }
    .chat-list ul li{

        list-style: none;
    }
    .chat-list .chat-img img{
        height: 40px;
        width: 40px;
        border-radius: 50%;
    }
    .chat-time{
        font-size: 11px;
        float: right;
        padding: 5px 5px;
    }
    .profile-image{
        float: left;
        width:5%
    }
    .profile-name{

        display: block;
        width:95%;
        overflow:hidden;
    }
    .chat-content{
        display: block;
        padding-left: 10px;
    }
</style>
