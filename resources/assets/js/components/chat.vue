<script>
    export default{
        data(){
            return{
                messages: [],
                your: {},
                newMessage: ''
            }
        },
        components:{

        },
        methods: {
            alert: function () {
                alert(this.msg);
            },
            createNewMessage: function () {
                if (this.newMessage != ''){
                    this.$http.post('/vue/new/message', {
                        message: this.newMessage
                    });
                    this.newMessage = '';

                    return
                }
                Materialize.toast("Você não pode enviar uma mensagem vazia !", 4000, 'warning rounded');
                return
            }
        },
        mounted(){
            this.$http.post('/vue/get/your').then((res) => {
                this.your = res.data.user;
            });

            this.$http.post('/vue/get/messages').then((res) => {
                console.log(res);
                this.messages = res.data.messages;

            });

            Echo.channel('public')
                    .listen('MessageWasReceived', (res)=>{
                        console.log(res);
                        var resMessage = res.message;
                        resMessage.user = res.user;
                        resMessage.user.setting = res.setting;
                        this.messages.unshift(resMessage);
                    });
        }
    }
</script>

<style lang="sass" scoped>
    #chat-window {
        height: 500px;
        overflow: scroll;
        overflow-x: hidden;
        }

    .object-fit_fill { object-fit: fill }
    .object-fit_contain { object-fit: contain }
    .object-fit_cover { object-fit: cover }
    .object-fit_none { object-fit: none }
    .object-fit_scale-down { object-fit: scale-down }
    .object-fill-container {
        width: 150px;

        img {
            height: 150px;
        }
    }

</style>

<template>
    <div>
        <div class="row">
            <div class="col s12 m12 l8 offset-l2 card-panel">
                <div class="row">
                    <div class="col s12 m12 l12" id="chat-window">
                        <div v-for="msg in messages">
                            <div class="row valign-wrapper z-depth-3">
                                <div class="col s2 m2 l3 object-fill-container">
                                    <a :href="'profile?id='+msg.user.id">
                                        <img :src="'storage/images/'+msg.user.setting.profilepic" class="circle responsive-img object-fit_fill z-depth-2">
                                        <br>
                                    </a>
                                </div>
                                <div class="col s10 m10 l9">
                                    <blockquote class="black-text">
                                        <a :href="'profile?id='+msg.user.id">
                                            {{ msg.user.name+' '+msg.user.last_name }} <br>
                                        </a>
                                        {{ msg.message }}
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s10 m10 l10">
                        <input placeholder="Digite sua mensagem aqui" type="text" v-model="newMessage" @keyup.enter="createNewMessage">
                    </div>
                    <div class="col s2 m2 l2">
                        <button type="submit" class="btn" @click="createNewMessage">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>