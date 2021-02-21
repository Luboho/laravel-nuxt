<template>
  <Container >
    <a-row type="flex" justify="center" align="middle">
      <a-col v-for="course in this.courses.courses" :xs="24" :sm="24" :md="24" :lg="8" :xl="8" :key="course.id">
        <card :title="course.title" :link="course.slug">
          <p>{{ course.description }}</p>
          <img src="@/assets/images/lesson.jpg" style="max-width: 100px;" alt="">
        </card>
      </a-col>
    </a-row>
  </Container>
</template>

<script>
import Container from '../components/Container';
import Card from '../components/Card';
import { mapState } from 'vuex'

export default {

  components: {
    Container,
    Card
  },

  async fetch({store}) {
    return await store.dispatch('courses/get')
  },

  computed: {
    ...mapState(['courses'])
  }
}
</script>

