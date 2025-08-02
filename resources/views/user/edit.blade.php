@extends('layouts.app')

@section('title', 'Edit Users')

@section('content')
<div id="app">
    <edit-user-modal ref="editModal"></edit-user-modal>

    <div class="user-list">
        @foreach($users as $user)
            <button class="edit-button" @click="editUser({{ $user->id }})">
                Edit {{ $user->name }}
            </button>
        @endforeach
    </div>
</div>

@vite('resources/js/app.js') {{-- Vue entry point --}}
@endsection

@push('scripts')
<script type="module">
import { createApp } from 'vue'
import EditUserModal from '../Components/EditUserModal.vue'

const app = createApp({
  methods: {
    editUser(id) {
      this.$refs.editModal.fetchUser(id)
    }
  }
})

app.component('edit-user-modal', EditUserModal)
app.mount('#app')
</script>
@endpush
