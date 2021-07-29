<template>
<app-layout>
    <div class="container mt-4">
   <div class="row">

       <div class="col-8">
           <div class="card card-default">
               <div class="card-header">Messages</div>
               <div class="card-body p-0">
                   <ul v-if="messages.length>0" class="list-unstyled" style="height:300px; overflow-y:scroll" >
                       <li class="p-2" v-for="(message, index) in messages" :key="index" >
                           <strong>{{ message.user.name }}</strong>
                           {{ message.message }}
                       </li>
                   </ul>
               </div>

               <input
                    @keydown="sendTypingEvent"
                    @keyup.enter="sendMessage"
                    v-model="newMessage"
                    type="text"
                    name="message"
                    placeholder="Enter your message..."
                    class="form-control">
           </div>
            <span class="text-muted" v-if="activeUser" >{{ activeUser.name }} is typing...</span>
       </div>

        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <ul>
                        <li class="py-2" v-for="(user, index) in users" :key="index">
                            {{ user.name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

   </div>
   </div>
   </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
export default {
    components:{AppLayout},
    props:{messages:Object,Allusers:Object},
    data(){
        return{
            users:this.Allusers,
            activeUser:null,
            newMessage:"",
            typingTimer: false,
        }
    },
    methods:{
        sendMessage(){
            
            this.messages.push(
                {
                    user:this.$page.props.user,
                    message:this.newMessage
                }
            )

            axios.post(route('send'),{'message':this.newMessage})
            this.newMessage=""

        },
        sendTypingEvent(){
            var self=this
            Echo.join('chat')
                    .whisper('typing', this.$page.props.user);
        }
    },
    created(){
        var self=this
        Echo.join('chat')
                .here(user => {
                    this.users = user;
                })
                .joining(user => {
                    this.users.push(user);
                })
                .leaving(user => {
                    this.users = this.users.filter(u => u.id != user.id);
                }).listen('MessageSent',(event) => {
                    this.messages.push(event.message); 
                    
                }).listenForWhisper('typing', user => {
                   self.activeUser = user;
                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                   this.typingTimer = setTimeout(() => {
                       this.activeUser = null;
                   }, 3000);
                }) 
    }
}
</script>