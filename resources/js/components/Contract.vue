

<template>

<div class="card mt-3 ">
  
  <h5 class="card-header text-center background-gradient">Gestionar Contratos</h5>
  <div class="card-body">

    <!-- New Contract Open modal button -->
    <button type="button" class="btn btn-outline-success  mt-2 mb-3" @click="(modificar = false), openModal()" title="Crear nuevo contrato con sus tarifas">  
      <i class="fas fa-plus"></i> Nuevo 
    </button> 

    <!-- Modal -->
    <div class="modal" :class="{ showModal: modal }">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ modalTitle }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <label for="name"> Nombre</label>
              <input v-model="contract.name" type="text" required  class="form-control" id="name"  placeholder="Nombre"/>
              <span class="text-danger" v-if="fails.name">{{fails.name[0]}}</span>
            </div>
            <div>
              <label for="date"> Fecha</label>
              <input v-model="contract.date" type="date" required class="form-control" id="date" placeholder="Fecha"/>
              <span class="text-danger" v-if="fails.date">{{fails.date[0]}}</span>
            </div>
            <div>

              <label for="file"> Archivo</label>
              <input type="file" name="excel_file" id="file" ref="file" required v-on:change="handleFileUpload()" accept=".XLSX, .CSV" class="form-control">
            </div>
          </div>
          <div class="modal-footer" >
            <div v-if="!isFetchingPost">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" @click="closeModal()"> Cerrar
              </button>
              <button type="button" class="btn btn-outline-success" @click="save()">
                Guardar
              </button>
            </div>
            <div v-else class="spinner-border text-primary text-center" role="status">
                <span class="sr-only">Cargando...</span>
              </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- New Contract End Modal -->

<!-- List Rates Modal -->
    <div class="modal" :class="{ showModal: modalListRates }">
      <div class="modal-dialog modal-lg">
        <div class="modal-content ">

          <div class="modal-header">
            <h5 class="modal-title w-100 text-center"><strong>{{ modalTitleRates }}</strong></h5>
          </div>

          <div class="modal-body">
             <!-- start Table -->
            <div>

              <table class="table responsive table-striped table-sm table-hover" v-if="!isFetchingRates">
                <thead>
                  <tr class="text-center">
                    <th >Origen</th>
                    <th >Destino</th>
                    <th >Tarifa 20</th>
                    <th >Tarifa 40</th>
                    <th >Tarifa 40 HC</th>
                    <th >Moneda</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="rate in rates.data" :key="rate.id" class="text-center">
                    <td>{{ rate.origin }}</td>
                    <td>{{ rate.destination }}</td>
                    <td>{{ rate.twenty }}</td>
                    <td>{{ rate.forty }}</td>
                    <td>{{ rate.fortyhc }}</td>
                    <td>{{ rate.currency }}</td>
                  </tr>
                </tbody>
              </table>
              <div v-else class="spinner-border text-primary text-center" role="status">
                <span class="sr-only">Cargando...</span>
              </div>
            </div>
            <!-- start Pagination -->
          <div class="row" v-if="this.rates.from != null">
            <div class="col-4 md-3 " style="text-align: center; align-self: center;">
              {{`Listando de ${rates.from} - ${rates.to} - Total: ${rates.total}`}} 
            </div>
            <div class="col-6 md-3">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item" :class="{ disabled: paginationRates.page == 1 }">
                    <a class="page-link" href="#" @click="paginationRates.page = 1; listRatesModal();">&laquo;</a>
                  </li>
                  <li class="page-item" :class="{ disabled: paginationRates.page == 1 }">
                    <a class="page-link" href="#" @click=" paginationRates.page--; listRatesModal();">
                      &lt;</a>
                  </li>
                  <li class="page-item" v-for="n in rates.last_page" :key="n" :class="{ disabled: paginationRates.last_page == n }">
                    <a class="page-link" href="#" @click="paginationRates.page = n; listRatesModal();">{{ n }}</a>
                  </li>
                  <li class="page-item" :class="{ disabled: paginationRates.page == rates.last_page }">
                    <a class="page-link" href="#" @click="paginationRates.page++;listRatesModal();">&gt;</a>
                  </li>
                  <li class="page-item" :class="{ disabled: paginationRates.page == rates.last_page }">
                    <a class="page-link" href="#" @click="paginationRates.page = rates.last_page;listRatesModal();">&raquo;</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div  class="row text-center" v-else> <p>No hay datos para mostrar</p></div>
         <!-- end pagination -->
          </div>
            <!-- end table -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" @click="closeListRatesModal()"> Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- New Contract End Modal -->


    <!-- start Table -->
    <div class="text-center">


      <table class="table responsive table-striped table-sm table-hover" v-if="!isFetching">
        <thead>
          <tr class="text-center">
            <th >#</th>
            <th >Nombre</th>
            <th >Fecha</th>
            <th >Rates</th>
          </tr>
        </thead>
        <tbody >
          <tr v-for="contract in contracts.data" :key="contract.id" class="text-center">
            <th scope="row">{{ contract.id }}</th>
            <td>{{ contract.nombre }}</td>
            <td>{{ formatDate(contract.fecha) }}</td>
            <td><button class="btn btn-outline-info btn-sm" title="Ver listado de tarifas" @click="openListRatesModal(contract)"><i class="fas fa-search"></i> Ver</button></td>
          </tr>
        </tbody>
      </table>
        <div v-else class="spinner-border text-primary text-center" role="status">
          <span class="sr-only">Cargando...</span>
        </div>
    </div>
    <!-- end table -->
    
    <!-- start Pagination -->
    <div class="row" v-if="this.contracts.from != null">
      <div class="col-4 md-3 " style="text-align: center; align-self: center;" >
              {{`Listando de ${contracts.from} - ${contracts.to} - Total: ${contracts.total}`}} 
            </div>
      <div class="col-2 md-3">
          <select class="custom-select" v-model="pagination.per_page" @change="loadData();">
              <option value="3">3</option>
              <option value="5">5</option>
              <option value="8">8</option>
          </select>
      </div>
          <div class="col-6 md-3" >
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item" :class="{ disabled: pagination.page == 1 }">
                  <a class="page-link" href="#" @click="pagination.page = 1;loadData();">&laquo;</a>
                </li>
                <li class="page-item" :class="{ disabled: pagination.page == 1 }">
                  <a class="page-link" href="#" @click="pagination.page--;loadData();">&lt;</a>
                </li>
                <li class="page-item" v-for="n in pages" :key="n" :class="{ disabled: pagination.page == n }">
                  <a class="page-link" href="#" @click="pagination.page = n;loadData();">{{ n }}</a>
                </li>
                <li class="page-item" :class="{ disabled: pagination.page == contracts.last_page }">
                  <a class="page-link" href="#" @click="pagination.page++;loadData();">&gt;</a>
                </li>
                <li class="page-item" :class="{ disabled: pagination.page == contracts.last_page }" >
                  <a class="page-link" href="#" @click="pagination.page = contracts.last_page;loadData();">&raquo;</a>
                </li>
              </ul>
            </nav>
          </div>
    </div>
    <div  class="row text-center" v-else> <p>No hay datos para mostrar</p></div>
    <!-- end pagination -->
  </div>
</div>

 <!--  <div class="m-5">
    
  </div> -->
</template>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

export default {
  
  data() {
    
    return {
      /* contracts */
      contracts: [],
      modalTitle: "",
      modal: false,
      fails: {},
      contract: {
        name: "",
        date: "",
        id: null,
        file:null
      },
      pagination: {
        page: 1,
        per_page: 5,
      },
      isFetching:false,
      isFetchingPost:false,
      pages:[],

      /* rates */
      rates: [],
      isFetchingRates:false,
      rate:{},
      modalTitleRates:'',
      modalListRates: false,
      paginationRates: {
        page: 1,
        per_page: 10,
      },
    };
  },
  methods: {
    
    formatDate(date){
      if(date){
        let dateSplit = date.split('-')

        return dateSplit[2] +'/' +dateSplit[1] +'/' +dateSplit[0];

      }
    },
    /* contracts */
    handleFileUpload(){
      this.file = this.$refs.file.files[0];
    },
    async loadData() {
      this.isFetching = true
      const resut = await axios.get("contracts", { params: this.pagination });
      this.contracts = resut?.data;
      this.isFetching = false
      this.loadPages();
    },
    async save() {
      this.isFetchingPost = true
      const Swal = require('sweetalert2')
      try {
          let formData = new FormData();
              formData.append('file', this?.file);
              formData.append('name',this.contract?.name)
              formData.append('date',this.contract?.date)
          const result = await axios.post("/contracts", formData, {
                                                      headers: {
                                                          'Content-Type': 'multipart/form-data'
                                                      }
                                            }).then(response =>{

                                              if(response?.data?.status == 201){
                                                Swal.fire({
                                                  title: 'Guardado con éxito!!',
                                                  text: response?.data?.message,
                                                  icon: 'success',
                                                  confirmButtonText: 'Aceptar'
                                                });
                                                this.closeModal();
                                              }else{
  
                                                if(response?.data?.status == 203){
                                                    Swal.fire({
                                                      title: 'Archivo invalido!!',
                                                      text: response?.data?.message,
                                                      icon: 'info',
                                                      confirmButtonText: 'Aceptar'
                                                    });
                                                    this.openModal();
                                                }else{
  
                                                  Swal.fire({
                                                    title: 'Error!',
                                                    text: response?.data?.message,
                                                    icon: 'error',
                                                    confirmButtonText: 'Aceptar'
                                                  });
                                                  this.closeModal();
                                                }
                                                
                                              }
                                            }).catch(error => 
                                            {
                                              Swal.fire({
                                                    title: 'Error!',
                                                    text: 'Verifique el archivo que esta enviado y vuelva a intentar',
                                                    icon: 'error',
                                                    confirmButtonText: 'Aceptar'
                                                  });
                                            }
                                            )
        
        this.loadData();
      } catch (error) {
        if (error.response.data) {
          this.fails = error.response.data.errors;
        }
      }
      this.isFetchingPost =false
    },
    openModal(data = {}) {
      //set title
      this.modalTitle = "Crear Contrato";

      //open modal
      this.modal = true;

      //reset values
      this.$refs.file.value = null
      this.contract.name = "";
      this.contract.date = "";
      this.contract.id = null;
      
    },
    closeModal() {
      this.modal = false;
      this.fails = {};
    },
    loadPages() {
      const n = 2;
      let arrayN = [];
      let inicio = this.pagination.page - 2;
      let fin = this.pagination.page + 2;

      if (inicio < 1) {
        inicio = 1;
      }
      if (fin >this.contracts.last_page) {
        fin  = this.contracts.last_page;
      }

      for (let index = inicio; index <=fin ; index++) {
          arrayN.push(index)
          
      }
      this.pages = arrayN;
    },

    /* rates */
    async openListRatesModal(data) {
      this.rates = [];
      this.rate = {};
      this.isFetchingRates = true;
      const resut = await axios.get("/rates/"+data?.id, { params: this.paginationRates }).then(response =>{
        if(response?.status == 200){
          this.modalTitleRates = `Nombre: ${data?.nombre} - Fecha: ${data?.fecha}`
          this.rates = response?.data?.records;
          this.rate = data;
          this.modalListRates = true;
        }
      })
      this.isFetchingRates = false;
    },
    async listRatesModal() {
      this.isFetchingRates = true;
      const resut = await axios.get("/rates/"+this.rate.id, { params: this.paginationRates }).then(response =>{
        if(response?.status == 200){
          this.modalTitleRates = `Nombre: ${this.rate?.nombre} - Fecha: ${this.rate?.fecha}`
          this.rates = response?.data?.records;
        }
      })
      this.isFetchingRates = false;
   
    },
    closeListRatesModal() {
      this.modalListRates = false;
    },
  },
  created() {
    this.loadData();
  },
  
};
</script>

<style>
  .showModal {
    display: list-item;
    opacity: 1;
    background: rgba(102, 133, 149, 0.8);
  }
  .background-gradient {
    background-color: #f7f7f7;
    border-bottom: 5px solid #031B4E;
  }
</style>