<template>
  <ul v-if="posts && posts.length">
    <li v-for="post of posts">
      <p>
        <strong>{{post.title}}</strong>
      </p>
      <p>{{post.visual_and_thumbnail_description}}</p>
    </li>
  </ul>

  <!-- <ul v-if="errors && errors.length">
    <li v-for="error of errors">{{error.message}}</li>
  </ul> -->
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
    axios
      .get(`https://actu.epfl.ch/api/jahia/channels/mediacom/news/fr/?format=json&limit=50`)
      .then(response => {
        // JSON responses are automatically parsed.
        this.posts = response.data;
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