<template>
  <div class="levels">
    <div class="row">
      <div class="col-6">
        <h4 class="btn-register" @click="modalLevels()">
          Níveis <span class="new-register">+</span>
        </h4>
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
            <th class="col-1 orders-level" @click="ordersLevels('id')">
              #
              <b-icon v-if="orders.id === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.id === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th class="col-5 orders-level" @click="ordersLevels('level')">
              Nível
              <b-icon v-if="orders.level === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.level === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th class="col-2 align-center orders-level" @click="ordersLevels('levelCount')">
              Qtd. devs
              <b-icon v-if="orders.levelCount === 'DESC'" icon="arrow-down"></b-icon>
              <b-icon v-if="orders.levelCount === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th class="col-2 align-center orders-level" @click="ordersLevels('created_at')">
                Criado em
                <b-icon v-if="orders.created_at === 'DESC'" icon="arrow-down"></b-icon>
                <b-icon v-if="orders.created_at === 'ASC'" icon="arrow-up"></b-icon>
            </th>
            <th class="col-2 align-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(level, i) in pageOfItems" :key="i">
            <th>{{ level.id }}</th>
            <td>{{ level.level }}</td>
            <td class="align-center">{{ level.levelCount }}</td>
            <td class="align-center">{{ level.created }}</td>
            <td class="align-center">
              <span class="m-1 action-option">
                <b-icon @click="modalLevels(i)" icon="pencil"></b-icon>
              </span>
              <span class="m-1 action-option">
                <b-icon @click="checksLevel(level.id, i)" icon="trash"></b-icon>
              </span>
            </td>
          </tr>
        </tbody>
      </table>
      <div
        v-if="pageOfItems.length === 0"
        class="alert alert-primary align-center mt-3">
          Não tem nenhum nível cadastrado ou nenhum nível com essas informações!
      </div>
      <div class="card-footer pb-0 pt-3">
        <jw-pagination
          @changePage="onChangePage"
          :items="levels"
          :pageSize="5"
          :labels="customLabels">
        </jw-pagination>
      </div>
    </div>
    <b-modal id="modal-levels" hide-footer :title="modal.text">
      <div class="row">
        <div class="mb-2">
          <label class="form-label">Nível</label>
          <input type="text" class="form-control" v-model="fields.level" placeholder="Nível">
          <div v-if="error.level === true" class="alert alert-danger mt-2" role="alert">
            {{errorText.level}}
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

export default {
  name: 'LevelsComponent',
  data () {
    return {
      customLabels,
      levels: [],
      pageOfItems: [],
      search: '',
      modal: {
        type: null,
        text: ''
      },
      fields: {
        id: null,
        level: ''
      },
      orders: {
        id: 'DESC',
        level: 'DESC',
        created_at: 'DESC',
        levelCount: 'DESC'
      },
      errorText: {
        level: ''
      },
      error: {
        level: false
      }
    }
  },

  created () {
    this.getLevels()
    EventBus.$on('clickedEventBus', () => {
      this.getLevels()
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
    submit () {
      if (this.validateForm() === false) {
        this.$toast.error('Opss! Corrija os campos antes de continuar!')
        return
      }
      if (this.fields.id !== null) {
        this.updateLevel()
      }
      if (this.fields.id === null) {
        this.newLevel()
      }
    },
    getLevels () {
      const self = this
      api.get('/levels')
        .then(function (response) {
          self.levels = response.data.data
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao buscar níveis!')
        })
    },
    getSearch (text) {
      if (text === '') {
        this.getLevels()
        return
      }
      const self = this
      api.post('/levels/search', { search: text })
        .then(function (response) {
          self.levels = response.data.data
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao buscar níveis!')
        })
    },
    newLevel () {
      const self = this
      api.post('/levels', self.fields)
        .then(function () {
          self.getLevels()
          self.emitGlobalClickEventDev()
          self.$toast.success('Nível criado com secesso!')
          self.$bvModal.hide('modal-levels')
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao criar nível!')
        })
    },
    updateLevel () {
      const self = this
      api.put(`/levels/${self.fields.id}`, self.fields)
        .then(function () {
          self.getLevels()
          self.emitGlobalClickEventDev()
          self.$toast.success('Nível atualizado com secesso!')
          self.$bvModal.hide('modal-levels')
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao atualizar nível!')
        })
    },
    deleteLevel (id) {
      const self = this
      api.delete(`/levels/${id}`)
        .then(function () {
          self.getLevels()
          self.emitGlobalClickEventDev()
          self.$toast.success('Nível excluido com secesso!')
        })
        .catch(function () {
          self.$toast.error('Opss! Erro ao excluir nível!')
        })
    },
    checksLevel (id, i) {
      if (this.pageOfItems[i].levelCount >= 1) {
        this.$toast.error('Opss! Nível não pode ser excluido, tem desenvolvedor(es) vinculado(s) a ele!')
        return
      }
      this.deleteLevel(id)
    },
    modalLevels (type = '') {
      this.resetErrors()
      this.resetForm()
      if (type === '') {
        this.modal.type = type
        this.modal.text = 'Novo nível'
        this.$bvModal.show('modal-levels')
      }

      if (type !== '') {
        this.modal.type = type
        this.modal.text = 'Atualizando nível'
        this.$bvModal.show('modal-levels')
        this.fields.level = this.pageOfItems[type].level
        this.fields.id = this.pageOfItems[type].id
      }
    },
    validateForm () {
      this.resetErrors()
      if (this.fields.level === '') {
        this.error.level = true
        this.errorText.level = 'Por favor, insira o nível!'
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
      if (type === 'level') {
        if (this.orders.level === 'DESC') {
          this.orders.level = 'ASC'
          this.pageOfItems.sort(sortBy('-level'))
        } else {
          this.orders.level = 'DESC'
          this.pageOfItems.sort(sortBy('level'))
        }
      }
      if (type === 'created_at') {
        if (this.orders.created_at === 'DESC') {
          this.orders.created_at = 'ASC'
          this.pageOfItems.sort(sortBy('-created_at'))
        } else {
          this.orders.created_at = 'DESC'
          this.pageOfItems.sort(sortBy('created_at'))
        }
      }
      if (type === 'levelCount') {
        if (this.orders.levelCount === 'DESC') {
          this.orders.levelCount = 'ASC'
          this.pageOfItems.sort(sortBy('-levelCount'))
        } else {
          this.orders.levelCount = 'DESC'
          this.pageOfItems.sort(sortBy('levelCount'))
        }
      }
    },
    emitGlobalClickEventDev () {
      EventBus.$emit('getNewListLevelsDevs')
    },
    resetErrors () {
      this.error.level = false
    },
    resetForm () {
      this.fields.id = null
      this.fields.level = ''
    }
  }
}
</script>

<style>
.levels {
  padding: 0 20px;
}
.action-option {
  cursor: pointer;
}
.align-center{
  text-align: center;
}
.orders-level {
  cursor: pointer;
}
</style>
