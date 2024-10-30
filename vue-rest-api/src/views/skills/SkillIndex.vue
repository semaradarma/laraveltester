<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import useSkills from "../../composables/skills";

const { skills, getSkills, destroySkill } = useSkills();
const loading = ref(true);
const error = ref(null);
const router = useRouter();

const editSkill = (id) => {
  router.push({ name: 'SkillEdit', params: { id } });
};

const deleteSkill = async (id) => {
  try {
    await axios.delete(`/api/skills/${id}`);
    skills.value = skills.value.filter(skill => skill.id !== id);
  } catch (err) {
    error.value = "Gagal menghapus keterampilan.";
  }
};

onMounted(async () => {
  try {
    await getSkills();
  } catch (err) {
    error.value = "Gagal memuat keterampilan.";
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <div class="mt-12">
    <div class="flex justify-end m-2 p-2">
      <RouterLink :to="{ name: 'SkillCreate' }" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded">New Skill</RouterLink>
    </div>
    <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
          <tr>
            <th scope="col" class="px-6 py-3">Nama</th>
            <th scope="col" class="px-6 py-3">Slug</th>
            <th scope="col" class="px-6 py-3"></th>
          </tr>
        </thead>
        <tbody>
          <template v-if="loading">
            <tr>
              <td colspan="3" class="text-center px-6 py-4">Memuat...</td>
            </tr>
          </template>
          <template v-else-if="error">
            <tr>
              <td colspan="3" class="text-center px-6 py-4 text-red-600">{{ error }}</td>
            </tr>
          </template>
          <template v-else>
            <tr v-for="skill in skills" :key="skill.id" class="bg-white border-b dark:bg-gray-100 dark:border-gray-500">
              <td class="px-6 py-4 text-gray-900">{{ skill.name }}</td>
              <td class="px-6 py-4 text-gray-900">{{ skill.slug }}</td>
              <td class="px-6 py-4 space-x-2">
                <RouterLink :to="{name: 'SkillEdit', params: {id: skill.id} }" class="px-4 py-2 mt-2 bg-green-500 hover:bg-green-700 text-white rounded">Edit</RouterLink>
                <button @click="destroySkill(skill.id)" class="px-4 py-2 mt-2 bg-red-500 hover:bg-red-700 text-white rounded">Hapus</button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</template>