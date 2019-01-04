<template>
  <!-- contacts card -->
  <div class="card card-default" id="card_contacts">
    <div id="contacts" class="panel-collapse collapse show" aria-expanded="true" style>
      <ul class="list-group pull-down" id="contact-list">
        <li
          class="list-group-item"
          v-for="person in persons"
          :key="person.id"
          @click="redirect(person)"
        >
          <div class="row w-100">
            <div class="col-12 col-sm-6 col-md-3 px-0">
              <img
                src="https://abdullah-dev.tech/images/ies-me.jpg"
                alt="abdullah"
                class="rounded-circle mx-auto d-block img-fluid"
              >
            </div>
            <div class="col-12 col-sm-6 col-md-9 text-center text-sm-left">
              <span class="fa fa-mobile fa-2x text-success float-right pulse" title="online now"></span>
              <label class="name lead">{{person.name}}</label>
              <br>
              <span
                class="fa fa-map-marker fa-fw text-muted"
                data-toggle="tooltip"
                title
                data-original-title="5842 Hillcrest Rd"
              ></span>
              <span class="text-muted">{{ person.address }}</span>
              <br>
              <span
                class="fa fa-phone fa-fw text-muted"
                data-toggle="tooltip"
                title
                data-original-title="(870) 288-4149"
              ></span>
              <span class="text-muted small">{{ person.phone }}</span>
              <br>
              <span
                class="fa fa-envelope fa-fw text-muted"
                data-toggle="tooltip"
                data-original-title
                title
              ></span>
              <span class="text-muted small text-truncate">{{ person.email }}</span>
            </div>
          </div>
        </li>
      </ul>
      <!--/contacts list-->
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    redirect(val) {
      window.location.href = "/chat/" + val.id;
    }
  },
  data() {
    var abdullah = {
        id: 1,
        name: "Abdullah",
        address: "Jakarta",
        phone: "099999999",
        email: "abdullah@example.com"
      }, 
      umar = {
        id: 2,
        name: "Umar",
        address: "Surabaya",
        phone: "099999999",
        email: "umar@example.com"
      },
      ali = {
        id: 3,
        name: "Ali",
        address: "Gresik",
        phone: "099999999",
        email: "ali@example.com"
      };
    return {
      persons: [abdullah, umar, ali]
    };
  }
};
</script>