<template>
  <ul>
    <input type="button" value="Prev" />
    <input type="button" value="Next" />
    <p>
      <strong>{{posts[0].title}}</strong>
    </p>
    <img :src="posts[0].hdurl" alt="APOD" />
    <strong>{{posts[0].copyright}}</strong>
    <!-- <p>{{post.visual_and_thumbnail_description}}</p> -->
  </ul>

  <!-- <ul v-if="errors && errors.length">
    <li v-for="error of errors">{{error.message}}</li>
  </ul>-->
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      posts: [],
      errors: []
    };
  },

  // Fetches posts when the component is created.
  created() {
    var date = new Date();
    date.setDate(date.getDate() + 1);
    console.log();

    axios
      .get(`https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY&date=` + date)
      .then(response => {
        // JSON responses are automatically parsed.
        this.posts[0] = response.data;
      })
      .catch(e => {
        this.errors.push(e);
      });

    // async / await version (created() becomes async created())
    //
    // try {
    //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
    //   this.posts = response.data
    // } catch (e) {
    //   this.errors.push(e)
    // }
  }
};
</script>