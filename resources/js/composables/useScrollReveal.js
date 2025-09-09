import { ref, onMounted, onUnmounted } from 'vue'

export default function useScrollReveal(animation = 'animate__fadeInUp', threshold = 0.2) {
  const element = ref(null)
  const isVisible = ref(false)

  let observer = null

  onMounted(() => {
    observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          isVisible.value = true
          observer.disconnect() // hanya satu kali animasi
        }
      },
      {
        threshold,
      }
    )

    if (element.value) {
      observer.observe(element.value)
    }
  })

  onUnmounted(() => {
    if (observer && element.value) {
      observer.unobserve(element.value)
    }
  })

  return {
    element,
    isVisible,
    animation,
  }
}
