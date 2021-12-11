<template>
  <div class="developers">
    <div class="row">
      <div class="col-6">
        <h4 class="btn-register" @click="modalDevelopers()">Desenvolvedores <span class="new-register">+</span></h4>
      </div>
      <div class="col-6">
        <div class="search-filter">
          <input type="text" class="form-control" v-model="search" placeholder="Filtrar dados">
        </div>
      </div>
    </div>
    <div class="row">
      <table v-if="pageOfItems.length >= 1" class="table mt-4">
        <thead>
          <tr>
            <th scope="col" class="orders-level" @click="ordersLevels('id')">
              #
              <b-icon v-if="orders.id === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.id === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th scope="col" class="orders-level" @click="ordersLevels('name')">
              Nome
              <b-icon v-if="orders.name === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.name === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th scope="col" class="orders-level" @click="ordersLevels('gender')">
              Sexo
              <b-icon v-if="orders.gender === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.gender === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th scope="col" class="orders-level" @click="ordersLevels('birth')">
              Nascimento
              <b-icon v-if="orders.birth === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.birth === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th scope="col" class="orders-level" @click="ordersLevels('age')">
              Idade
              <b-icon v-if="orders.age === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.age === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th scope="col" class="orders-level" @click="ordersLevels('hobby')">
              Hobby
              <b-icon v-if="orders.hobby === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.hobby === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th scope="col" class="orders-level" @click="ordersLevels('level_id')">
              Nível
              <b-icon v-if="orders.level_id === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.level_id === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(dev, i) in pageOfItems" :key="i">
            <th scope="row">{{dev.id}}</th>
            <td>{{dev.name}}</td>
            <td>{{ dev.gender === 'M' ? 'Masculino' : 'Feminino'}}</td>
            <td>{{ formatMoment(dev.birth) }}</td>
            <td>{{ dev.age }}</td>
            <td>{{ dev.hobby }}</td>
            <td>{{ dev.level }}</td>
            <td>
              <span class="m-1 action-option">
                <b-icon @click="modalDevelopers(i)" icon="pencil"></b-icon>
              </span>
              <span @click="deleteDeveloper(dev.id)" class="m-1 action-option">
                <b-icon icon="trash"></b-icon>
              </span>
            </td>
          </tr>
        </tbody>
      </table>
      <div
        v-if="pageOfItems.length === 0"
        class="alert alert-primary align-center mt-3">
          Não tem nenhum desenvolvedor cadastrado ou nenhum desenvolvedor com essas informações!
      </div>
      <div class="card-footer pb-0 pt-3">
        <jw-pagination
          @changePage="onChangePage"
          :items="developers"
          :pageSize="5"
          :labels="customLabels">
        </jw-pagination>
      </div>
    </div>
    <b-modal id="modal-developers" hide-footer :title="modal.text">
      <div class="row">
        <div class="mb-2">
          <label class="form-label">Nome</label>
          <input type="text" class="form-control" v-model="fields.name" placeholder="Nome">
          <div v-if="error.name === true" class="alert alert-danger mt-2" role="alert">
            {{errorText.name}}
          </div>
        </div>
        <div class="mb-2">
          <label class="form-label">Sexo</label>
          <select class="form-select" v-model="fields.gender">
            <option value="">Selecione uma opção</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
          </select>
          <div v-if="error.gender === true" class="alert alert-danger mt-2" role="alert">
            {{errorText.gender}}
          </div>
        </div>
        <div class="padding-age row">
          <div class="col-8">
            <div class="mb-2">
              <label class="form-label">Data de nascimento</label>
              <input type="date" @blur="calcAge()" class="form-control" v-model="fields.birth" placeholder="Data de nascimento">
              <div v-if="error.birth === true" class="alert alert-danger mt-2" role="alert">
                {{errorText.birth}}
              </div>
            </div>
          </div>
          <div class="col-4 padding-age">
            <div class="mb-2">
              <label class="form-label">Idade</label>
              <input type="number" class="form-control" v-model="fields.age" placeholder="Idade">
              <div v-if="error.age === true" class="alert alert-danger mt-2" role="alert">
                {{errorText.age}}
              </div>
            </div>
          </div>
        </div>
        <div class="mb-2">
          <label class="form-label">Conte seu hobby</label>
          <input type="text" class="form-control" v-model="fields.hobby" placeholder="Conte seu hobby">
          <div v-if="error.hobby === true" class="alert alert-danger mt-2" role="alert">
            {{errorText.hobby}}
          </div>
        </div>
        <div class="mb-2">
          <label class="form-label">Nível</label>
          <select class="form-select" v-model="fields.level_id">
            <option value="0">Selecione um nível</option>
            <option v-for="(level, i) in levels" :key="i"
              :value="level.id">
              {{level.level}}
            </option>
          </select>
          <div v-if="error.level_id === true" class="alert alert-danger mt-2" role="alert">
            {{errorText.level_id}}
          </div>
        </div>
      </div>
      <button type="submit" @click="submit()" class="btn btn-primary mt-2">{{modal.text}}</button>
    </b-modal>
  </div>
</template>

<script>
import api from '../services/index'
import customLabels from '../services/labels'
import { EventBus } from '../services/eventBus'
import sortBy from 'sort-by'
import moment from 'moment'

export default {
  name: 'DevelopersComponent',
  data () {
    return {
      customLabels,
      levels: [],
      developers: [],
      pageOfItems: [],
      search: '',
      modal: {
        type: null,
        text: ''
      },
      fields: {
        id: null,
        name: '',
        gender: '',
        birth: '',
        age: '',
        hobby: '',
        level_id: 0
      },
      orders: {
        id: 'DESC',
        name: 'DESC',
        gender: 'DESC',
        birth: 'DESC',
        age: 'DESC',
        hobby: 'DESC',
        level_id: 'DESC'
      },
      errorText: {
        name: '',
        gender: '',
        birth: '',
        age: '',
        hobby: '',
        level_id: ''
      },
      error: {
        name: false,
        gender: false,
        birth: false,
        age: false,
        hobby: false,
        level_id: false
      }
    }
  },

  created () {
    this.getLevelsIds()
    this.getDevelopers()
    EventBus.$on('getNewListLevelsDevs', () => {
      this.getLevelsIds()
    })
  },

  watch: {
    search: function () {
      this.getSearch(this.search)
    }
  },

  methods: {
    onChangePage (pageOfItems) {
      this.pageOfItems = pageOfItems
    },
    getLevelsIds () {
      const self = this
      api.get('/levels')
        .then(function (response) {
          self.levels = response.data.data
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao buscar níveis!')
        })
    },
    getDevelopers () {
      const self = this
      api.get('/developers')
        .then(function (response) {
          self.developers = response.data.data
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao buscar desenvolvedor!')
        })
    },
    getSearch (text) {
      if (text === '') {
        this.getDevelopers()
        return
      }
      const self = this
      api.post('/developers/search', { search: text })
        .then(function (response) {
          self.developers = response.data.data
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao buscar desenvolvedor!')
        })
    },
    submit () {
      if (this.validateForm() === false) {
        this.$toast.error('Opss! Corrija os campos antes de continuar!')
        return
      }
      if (this.fields.id !== null) {
        this.updateDeveloper()
      }
      if (this.fields.id === null) {
        this.newDeveloper()
      }
      this.resetForm()
    },
    newDeveloper () {
      const self = this
      api.post('/developers', self.fields)
        .then(function () {
          self.getDevelopers()
          self.$toast.success('Desenvolvedor criado com secesso!')
          self.$bvModal.hide('modal-developers')
          self.emitGlobalClickEvent()
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao criar desenvolvedor!')
        })
    },
    updateDeveloper () {
      const self = this
      api.put(`/developers/${self.fields.id}`, self.fields)
        .then(function () {
          self.getDevelopers()
          self.$toast.success('Desenvolvedor atualizado com secesso!')
          self.$bvModal.hide('modal-developers')
          self.emitGlobalClickEvent()
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao atualizar desenvolvedor!')
        })
    },
    deleteDeveloper (id) {
      const self = this
      api.delete(`/developers/${id}`)
        .then(function () {
          self.getDevelopers()
          self.emitGlobalClickEvent()
          self.$toast.success('Desenvolvedor excluido com secesso!')
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao excluir desenvolvedor!')
        })
    },
    modalDevelopers (type = '') {
      this.resetForm()
      this.resetErrors()
      if (type === '') {
        this.modal.type = type
        this.modal.text = 'Novo desenvolvedor'
        this.$bvModal.show('modal-developers')
      }

      if (type !== '') {
        this.modal.type = type
        this.modal.text = 'Atualizando desenvolvedor'
        this.$bvModal.show('modal-developers')
        this.fields.id = this.pageOfItems[type].id
        this.fields.name = this.pageOfItems[type].name
        this.fields.gender = this.pageOfItems[type].gender
        this.fields.birth = this.pageOfItems[type].birth
        this.fields.age = this.pageOfItems[type].age
        this.fields.hobby = this.pageOfItems[type].hobby
        this.fields.level_id = this.pageOfItems[type].level_id
      }
    },
    emitGlobalClickEvent () {
      EventBus.$emit('clickedEventBus')
    },
    validateForm () {
      this.resetErrors()
      if (this.fields.name === '') {
        this.error.name = true
        this.errorText.name = 'Por favor, insira seu nome!'
        return false
      }
      if (this.fields.gender === '') {
        this.error.gender = true
        this.errorText.gender = 'Por favor, selecione seu sexo!'
        return false
      }
      if (this.fields.birth === '') {
        this.error.birth = true
        this.errorText.birth = 'Por favor, insira sua data de nascimento!'
        return false
      }
      if (this.fields.age === '') {
        this.error.age = true
        this.errorText.age = 'Por favor, insira sua idade!'
        return false
      }
      if (this.fields.hobby === '') {
        this.error.hobby = true
        this.errorText.hobby = 'Por favor, insira seu hobby!'
        return false
      }
      if (this.fields.level_id === 0) {
        this.error.level_id = true
        this.errorText.level_id = 'Por favor, selecione seu nível!'
        return false
      }
      return true
    },
    ordersLevels (type) {
      if (type === 'id') {
        if (this.orders.id === 'DESC') {
          this.orders.id = 'ASC'
          this.pageOfItems.sort(sortBy('-id'))
        } else {
          this.orders.id = 'DESC'
          this.pageOfItems.sort(sortBy('id'))
        }
      }
      if (type === 'name') {
        if (this.orders.name === 'DESC') {
          this.orders.name = 'ASC'
          this.pageOfItems.sort(sortBy('-name'))
        } else {
          this.orders.name = 'DESC'
          this.pageOfItems.sort(sortBy('name'))
        }
      }
      if (type === 'gender') {
        if (this.orders.gender === 'DESC') {
          this.orders.gender = 'ASC'
          this.pageOfItems.sort(sortBy('-gender'))
        } else {
          this.orders.gender = 'DESC'
          this.pageOfItems.sort(sortBy('gender'))
        }
      }
      if (type === 'birth') {
        if (this.orders.birth === 'DESC') {
          this.orders.birth = 'ASC'
          this.pageOfItems.sort(sortBy('-birth'))
        } else {
          this.orders.birth = 'DESC'
          this.pageOfItems.sort(sortBy('birth'))
        }
      }
      if (type === 'age') {
        if (this.orders.age === 'DESC') {
          this.orders.age = 'ASC'
          this.pageOfItems.sort(sortBy('-age'))
        } else {
          this.orders.age = 'DESC'
          this.pageOfItems.sort(sortBy('age'))
        }
      }
      if (type === 'hobby') {
        if (this.orders.hobby === 'DESC') {
          this.orders.hobby = 'ASC'
          this.pageOfItems.sort(sortBy('-hobby'))
        } else {
          this.orders.hobby = 'DESC'
          this.pageOfItems.sort(sortBy('hobby'))
        }
      }
      if (type === 'level_id') {
        if (this.orders.level_id === 'DESC') {
          this.orders.level_id = 'ASC'
          this.pageOfItems.sort(sortBy('-level_id'))
        } else {
          this.orders.level_id = 'DESC'
          this.pageOfItems.sort(sortBy('level_id'))
        }
      }
    },
    calcAge () {
      if (this.fields.birth.length >= 7) {
        this.fields.age = moment().diff(this.fields.birth, 'years', false)
      }
    },
    formatMoment (val) {
      return val ? moment(val).format('DD/MM/YYYY') : ''
    },
    resetErrors () {
      this.error.name = false
      this.error.gender = false
      this.error.birth = false
      this.error.age = false
      this.error.hobby = false
      this.error.level_id = false
    },
    resetForm () {
      this.fields.name = ''
      this.fields.name = ''
      this.fields.gender = ''
      this.fields.birth = ''
      this.fields.age = ''
      this.fields.hobby = ''
      this.fields.level_id = 0
    }
  }
}
</script>

<style>
.developers {
  padding: 0 20px;
}
.padding-age {
  padding-right: 0 !important;
}
.action-option {
  cursor: pointer;
}
</style>
