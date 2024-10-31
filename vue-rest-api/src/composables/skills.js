import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1/";

export default function useSkills() {
    const skills = ref([]);
    const skill = ref([]);
    const errors = ref({});
    const router = useRouter();

    const getSkills = async () => {
        try {
            const response = await axios.get("skills");
            skills.value = response.data.data;
        } catch (error) {
            console.error("Error fetching skills data:", error);
        }
    };

    const getSkill = async (id) => {
        try {
            const response = await axios.get("skills/" + id);
            skill.value = response.data.data;
        } catch (error) {
            console.error("Error fetching skill:", error);
        }
    };

    const storeSkill = async (data) => {
        try {
            await axios.post("skills", data);
            await router.push({ name: "SkillIndex" });
        } catch (error) {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
            } else {
                console.error("Error saving skill:", error);
            }
        }
    };

    const updateSkill = async (id, data) => {
        try {
            console.log(data);
            await axios.put(`update-skills/${id}`, data, {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            });
            await router.push({ name: "SkillIndex" });
        } catch (error) {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
            } else {
                console.error("Error updating skill:", error);
            }
        }
    };

    const destroySkill = async (id) => {
        if (window.confirm("Are you sure you want to delete this skill?")) {
            try {
                await axios.delete(`/delete-skills/${id}`);
                await getSkills(); // Refresh the skills list after deletion
            } catch (error) {
                console.error("Error deleting skill:", error);
            }
        }
    };

    return {
        skill,
        skills,
        getSkill,
        getSkills,
        storeSkill,
        updateSkill,
        destroySkill,
        errors,
    };
}
