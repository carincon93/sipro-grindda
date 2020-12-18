<template>
    <div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left">¿Aplica al posconflicto?</label>
            <div class="col-md-9">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="aplicacionPosconflictoSi" id="posconflictoSi" value="si" v-model="checkedPosconflicto" class="custom-control-input">
                    <label class="custom-control-label" for="posconflictoSi">Si</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="aplicacionPosconflictoNo" id="posconflictoNo" value="no" v-model="checkedPosconflicto" class="custom-control-input">
                    <label class="custom-control-label" for="posconflictoNo">No</label>
                </div>
            </div>
        </div>

        <transition name="slide-fade">
            <div v-if="checkedPosconflicto === 'si'">
                <div class="form-group row" v-bind:class="{'is-invalid' : errors['municipiosAImpactar']}">
                    <label class="col-md-3" for="municipiosAImpactar">Municipios a impactar <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input id="municipiosAImpactar" type="text" name="municipiosAImpactar" class="form-control" v-bind:class="{'is-invalid' : errors['municipiosAImpactar']}" required>
                        <span v-if="errors['municipiosAImpactar']" class="invalid-feedback">
                            <strong>{{ errors['municipiosAImpactar'][0] }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row" v-bind:class="{'is-invalid' : errors['descripcionEstrategia']}">
                    <label class="col-md-3" for="descripcionEstrategia">Descripción de la estratégia <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <textarea id="descripcionEstrategia" name="descripcionEstrategia" rows="8" cols="80" class="form-control" v-bind:class="{'is-invalid' : errors['descripcionEstrategia']}" required></textarea>
                        <span v-if="errors['descripcionEstrategia']" class="invalid-feedback">
                            <strong>{{ errors['descripcionEstrategia'][0] }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row" v-bind:class="{'is-invalid' : errors['recursosPosconflicto']}">
                    <label class="col-md-3" for="recursosPosconflicto">Recursos posconflicto ($COP) <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input id="recursosPosconflicto" type="number" pattern="[0-9]" min="0" max="9999999999" name="recursosPosconflicto" class="form-control" v-bind:class="{'is-invalid' : errors['recursosPosconflicto']}" required>
                        <span v-if="errors['recursosPosconflicto']" class="invalid-feedback">
                            <strong>{{ errors['recursosPosconflicto'][0] }}</strong>
                        </span>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script type="text/javascript">
export default {
    props: ['errors'],
    data: function () {
        return {
            checkedPosconflicto: 'no',
        }
    }
}
</script>
