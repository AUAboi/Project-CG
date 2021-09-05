<template>
	<button
		class="p-3 mx-2 bg-blue-400 text-white"
		@click="$emit('skillused', skill)"
	>
		{{ skill }}
	</button>
</template>
<script>
export default {
	props: {
		skill: {
			required: true,
			type: String
		}
	}
};
</script>