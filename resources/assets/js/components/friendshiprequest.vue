<script>
    export default{
        data(){
            return{
                pending: '',
                suggested: ''
            }
        },
        components:{
        
        },
        methods: {

        },
        mounted() {
            this.$http.post('/vue/get/friendships').then((res)=>{
                this.pending = res.data.pending;
                this.suggested = res.data.suggested;
            });
        }
    }
</script>

<style lang="sass">
.hide {
    display: none;
    }
</style>


<template>
    <li>
    <a href="#" data-beloworigin="true" data-alignment="right" data-constrainwidth="false" data-activates="friendship_dropdown" class="dropdown-button">
        <span class="mif" style="position: relative;top: 5px">supervisor_account</span>
        <span class="new badge" v-if="pending.lenght > 0">{{ pending.lenght }}</span>
    </a>

        <!--<a href="#!" data-beloworigin="true" data-alignment="right" data-constrainwidth="false" data-activates="friendship_dropdown" class="dropdown-button"><span class="mif" style="position: relative;top: 5px">supervisor_account</span>
                        @if(count(Auth::user()->getPendingFriendships()) > 0)
                            <span class="new badge">{{ count(Auth::user()->getPendingFriendships()) }}</span>
                        @endif
                    </a>
                    <ul id="friendship_dropdown" class="dropdown-content collection">
                        @if(count(Auth::user()->getPendingFriendships()) > 0)
                            @foreach(Auth::user()->getPendingFriendships() as $friendship)
                                <xf-friendship-request :from="{{ $friendship->sender->load('setting') }}"></xf-friendship-request>
                            @endforeach
                        @else
                            <li><a href="#">Não existem novos pedidos de amizade</a></li>
                        @endif
                        <li class="divider"></li>
                        <li><a href="#">Pessoas que você possa se interessar:</a></li>
                        @foreach(App\User::where('id','<>',Auth::user()->id)->get() as $user)
                            <xf-friendship-suggest :to="{{ $user->load('setting') }}"></xf-friendship-suggest>
                        @endforeach
                    </ul>-->
    </li>
</template>