<template>
  <div id="course" v-if="course">
    <section class="header">
      <h1>{{ course.title }}</h1>
      <p>{{ course.description }}</p>
          <img src="@/assets/images/lesson.jpg" style="max-width: 100px;" alt="">
    </section>

    <section class="lessons">
      <container>
        <template v-if="course.lessons">
          <a-row type="flex" justify="center" align="middle">
            <a-col v-for="lesson in this.course.lessons" :key="lesson.id" :xs="24" :sm="24" :lg="8" :xl="8">
              <card :title="lesson.title" :link="lesson.slug">
                <p>{{ lesson.description }} </p>
              </card>
            </a-col>
          </a-row>
        </template>
      </container>
    </section>
  </div>
</template>

<script>
import {mapState} from 'vuex'
import Card from '../../components/Card.vue'
import Container from '../../components/Container.vue'

export default {
  async fetch() { // Get the data faster without make axios again.
      await this.$store.dispatch('courses/getCourse', this.$route.params.slug)
  },

  components: {
     Container,
     Card 
  },
  async mounted() {

    if (await this.course.redirect == true) {
      await this.$notification.open({
        message: 'Error',
        description: 
          this.course.errors.root,
        // onClick: () => {
        //   console.log('Notification Clicked');
        // },
      });

      await this.$router.back();
    }
  },

  computed: {
    ...mapState({
      course: state => state.courses.course
    })
  }

}
</script>

<style>
  #course .header {
    margin-bottom: 10px;
    display: flex;
    flex-direction: column;
    height: 60vh;
    justify-content: center;
    align-items: center;
    background-color: #1890ff;
    padding: 20px;
  }

  #course .header h1 {
    font-size: 36px;
    color: #fff;
  }

  #course .header p {
    font-size: 24px;
    color: #fefefe;
  }
</style>