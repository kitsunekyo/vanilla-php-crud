const API_DEFAULTS = {
    baseUrl: "//localhost:8080",
    headers: () => ({}),
};

const api = async (method, url, payload) => {
    return await fetch(`${API_DEFAULTS.baseUrl}${url}`, {
        method,
        headers: API_DEFAULTS.headers(),
        body: method !== "get" ? JSON.stringify(payload) : undefined,
    }).then((res) => res.json());
};

Vue.component("events-list", {
    data: () => ({
        events: null,
        loading: false,
        error: false,
    }),
    mounted: function () {
        this.getEvents();
    },
    methods: {
        createEvent: async function () {
            const dummyEvent = {
                time: new Date().toISOString().slice(0, 19).replace("T", " "),
                details: "client generated",
                team_away_fk: 1,
                team_home_fk: 2,
            };
            try {
                const res = await api("post", "/events.php", dummyEvent);
                this.events.data = [
                    ...this.events.data,
                    { ...dummyEvent, id: res.id },
                ];
            } catch (e) {
                this.error = true;
                console.log(e);
            }
        },
        getEvents: async function () {
            this.loading = true;
            try {
                const res = await api("get", "/events.php");
                this.events = res;
                this.loading = false;
            } catch (e) {
                this.error = true;
                console.log(e);
            }
        },
        deleteEvent: async function (id) {
            try {
                const res = await api("delete", "/events.php", { id });
                this.events.data = this.events.data.filter((e) => e.id !== id);
            } catch (e) {
                this.error = true;
                console.log(e);
            }
        },
        formatDate: (date) =>
            new Date(date).toLocaleDateString("de-DE", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            }),
    },
    template: `
        <div v-if="loading">loading...</div>
        <div v-else-if="error">error!</div>
        <div v-else-if="!events">no events</div>
        <div v-else class="events-list">
            <button class="events-list__create" @click="createEvent()">add event</button>
            <div v-for="(event, i) in events.data" :key="event.id" class="events-list__item" :style="{'--i': i}">
                <div>{{formatDate(event.time)}}</div>
                <div>{{event.sport}}</div>
                <div>
                    <span>{{event.home_team}}</span> - <span>{{event.away_team}}</span>
                </div>
                <button class="events-list__delete" @click="deleteEvent(event.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </button>
            </div>
        </div>
    `,
});

const app = new Vue({
    el: "#app",
});
