<template>
	<div>
		<PlayerCharacter :charname="char.name" />
		<div>
			<ActionBar @skillused="updateFeed" :skills="char.skills" />
		</div>
		<div>
			Feed:
			<div>
				<ul>
					<li v-for="(item, index) in feed" :key="index">
						{{ item }}
					</li>
				</ul>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "axios";
export default {
	data() {
		return {
			char: {
				name: "Immortal",
				skills: [
					{
						name: "death-shot"
					},
					{
						name: "shield"
					}
				]
			},

			feed: []
		};
	},
	methods: {
		updateFeed(item) {
			axios.post("/api/action", item);
		}
	},
	mounted() {
		Echo.private(`game.${this.$user.id}`).listen(".ActionWasUsed", e => {
			console.log(e.gameState);
			let feedText = `${e.user.username} used ${e.action}`;
			this.feed.push(feedText);
		});
	}
};
</script>
