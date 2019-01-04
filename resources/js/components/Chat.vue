<template>
  <div class="container">
    <h3 class="text-center">Messaging</h3>
    <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <!-- <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar" placeholder="Search">
                <span class="input-group-addon">
                  <button type="button">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
                </span>
              </div>
               
            </div>-->
          </div>
          <div class="inbox_chat">
            <div
              class="chat_list"
              :class="{ active_chat: person.id === selected_member_id }"              
              :tabindex="person.id"
              v-for="person in persons"
              :key="person.id"
              @click="select(person)"
            >
              <div class="chat_people">
                <div class="chat_img">
                  <img src="https://abdullah-dev.tech/images/ies-me.jpg" alt="sunil">
                </div>
                <div class="chat_ib">
                  <h5>
                    {{person.name}}
                    <!-- <span class="chat_date">Dec 25</span> -->
                  </h5>
                  <p>
                    {{ lastMessage(person.id) }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history">
            <div :class="msg.type" v-for="msg in msg_history" :key="msg.id">
              <div class="incoming_msg_img" v-if="msg.type === 'incoming_msg'">
                <img src="https://abdullah-dev.tech/images/ies-me.jpg" alt="sunil">
              </div>
              <div class="received_msg" v-if="msg.type === 'incoming_msg'">
                <div class="received_withd_msg">
                  <p>{{ msg.text }}</p>
                  <!-- <span class="time_date">11:01 AM | June 9</span> -->
                </div>
              </div>
              <div class="sent_msg" v-if="msg.type === 'outgoing_msg'">
                <p>{{ msg.text }}</p>
                <!-- <span class="time_date">11:01 AM | June 9</span> -->
              </div>
            </div>
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <input
                type="text"
                @keyup.enter="send(data, msg_history)"
                v-model="data.text"
                class="write_msg"
                placeholder="Type a message"
              >
              <button class="msg_send_btn" type="button" v-show="selected_member_id != 0" @click="send(data, msg_history)">
                <i class="fa fa-rocket" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
var all_msg = {};
var path_name = window.location.pathname;
var selected_id = path_name.split("/")[2];

export default {
  mounted() {     
    Echo.private('message.100') 
    .listen('MessagePushed', (e) => {        
        if (selected_id == e.message.receiver_id) {
          var id = all_msg[e.message.sender_id].length + 1;
          this.all_msg[e.message.sender_id].push({
            id: id,
            type: "incoming_msg",
            text: e.message.text 
          });
          this.selected_member_id = e.message.sender_id;
        }                                                       
    });  
  },
  data() {
    var persons = [
      {
        id: 1,
        name: "Abdullah",
        address: "Jakarta",
        phone: "099999999",
        email: "abdullah@example.com",
        notification: false
      },
      {
        id: 2,
        name: "Umar",
        address: "Surabaya",
        phone: "099999999",
        email: "umar@example.com",
        notification: false
      },
      {
        id: 3,
        name: "Ali",
        address: "Gresik",
        phone: "099999999",
        email: "ali@example.com",
        notification: false
      }
    ];

    var selectedPerson = [];

    for (var i = 0; i < persons.length; i++) {
      var person = persons[i];
      if (person.id != selected_id) {
        selectedPerson.push(person);        
      }
      all_msg[person.id] = [];
    }

    var msg_history = [];

    return {
      persons: selectedPerson,
      msg_history: msg_history,
      selected_member_id: 0,
      all_msg: all_msg,
      data: {}
    };
  },
  methods: {
    send() {
      var id = this.msg_history.length + 1;
      this.msg_history.push({
        id: id,
        type: "outgoing_msg",
        text: this.data.text
      });
      this.all_msg[this.selected_member_id] = this.msg_history;  
      
      var data_send = {
        receiver_id: this.selected_member_id,
        sender_id: parseInt(selected_id),
        text: this.data.text      
      }; 
      console.log(data_send);
      window.axios.post('/api/send', data_send)
      .then(function (response) {})
      .catch(function (error) {});
      this.data.text = "";
    },    
    select(person) {      
      this.selected_member_id = person.id;
      this.msg_history = this.all_msg[person.id];
    },
    lastMessage(id) {
      if (this.all_msg[id].length > 0) {
        var last_index = this.all_msg[id].length - 1;        
        return this.all_msg[id][last_index].text;
      }
      return "";
    }
  },  
};
</script>
