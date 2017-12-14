<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>Notes</h1>
                    <h4>New Note</h4>
                    <form action="#" @submit.prevent="createComment()">
                        <div class="input-group">
                            <input v-model="comment.body" type="text" name="body" class="form-control" autofocus>
                            <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">New Comment</button>
                </span>
                        </div>
                    </form>
                    <h4>All Notes</h4>
                    <ul class="list-group">
                        <li v-if='list.length === 0'>There are no notes yet!</li>
                        <li class="list-group-item" v-for="(comment, index) in list">
                            {{ comment.body }}
                            <button @click="deleteComment(comment.id)" class="btn btn-danger btn-xs pull-right">Delete
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                list: [],
                comment: {
                    id: '',
                    body: ''
                }
            };
        },

        created() {
            this.fetchCommentList();
        },

        methods: {
            fetchCommentList() {
                axios.get('api/comments').then((res) => {
                    this.list = res.data;
                });
            },

            createComment() {
                axios.post('api/comments', this.comment)
                    .then((res) => {
                        this.comment.body = '';
                        this.edit = false;
                        this.fetchCommentList();
                    })
                    .catch((err) => console.error(err));
            },

            deleteComment(id) {
                axios.delete('api/comments/' + id)
                    .then((res) => {
                        this.fetchCommentList()
                    })
                    .catch((err) => console.error(err));
            },
        }
    }
</script>
