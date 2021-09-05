<template>
	<div class="flex">
		<div v-for="(skill, index) in skills" :key="index">
			<SkillBtn @skillused="$emit('skillused', skill)" :skill="skill.name" />
		</div>
	</div>
</template>

<script>
export default {
	props: {
		skills: {
			required: true
		}
	}
};
</script>
