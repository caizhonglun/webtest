<template>
<div class="row">
    <div class="modal fade" id="model-district">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ title }}</h4>
                </div>
                <div class="modal-body">
                    <vue-ckeditor
                        v-model="content"
                        toolbar="luxury"
                    ></vue-ckeditor>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                    <button type="button" class="btn btn-primary" @click="submit">儲存</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">操作面板</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <h4>學年度</h4>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <select class="form-control" v-model="year">
                            <option disabled value="">請選擇</option>
                            <option v-for="item in years" :value="item.year">{{ item.year }}</option>
                        </select>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <button type="button" class="btn btn-primary" @click="addYear">新增學年度</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" v-if="showMap">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ year }}學年 - 地區地圖</h3>
            </div>
            <div class="panel-body">
                <div class="col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                    <img id="Image-Maps-Com-image-maps" src="/images/area.gif" border="0" width="320" height="386" orgWidth="320" orgHeight="386" usemap="#image-maps" />
                    <map name="image-maps" id="ImageMapsCom-image-maps">
                        <area alt="復興區" title="復興區" shape="poly" @click="clickArea('復興區')"
                            coords="281,373,294,363,306,360,306,350,300,342,297,333,298,330,309,331,306,324,305,316,311,314,310,310,301,308,293,305,289,301,289,294,283,288,281,268,288,257,299,256,298,253,292,252,288,250,289,242,286,234,282,233,281,226,277,225,274,221,273,216,269,213,263,213,257,216,252,215,249,212,243,212,238,212,233,209,232,218,230,226,228,228,222,229,216,230,210,230,206,230,204,228,200,226,196,225,192,222,189,222,185,222,181,224,177,224,174,224,170,224,171,234,177,238,183,246,196,253,203,263,198,270,199,278,206,285,201,290,198,300,211,300,219,305,222,314,227,324,228,333,226,338,236,340,237,348,232,349,230,352,235,362,243,370,251,372,257,368,261,365,270,371"
                            style="outline:none;" target="_self" />
                        <area alt="大溪區" title="大溪區" shape="poly" @click="clickArea('大溪區')"
                            coords="221,228,230,225,230,216,230,209,232,197,230,192,236,190,237,185,231,182,229,178,226,173,218,173,216,170,217,166,216,162,213,161,214,157,222,156,228,153,228,149,223,147,217,148,213,146,208,148,201,153,197,156,194,154,190,149,186,150,181,153,177,154,173,158,173,166,174,176,172,182,170,187,179,187,181,195,178,200,172,211,165,217,166,224,176,223,183,224,189,222,199,226,210,230" style="outline:none;" target="_self" />
                        <area alt="龍潭區" title="龍潭區" shape="poly" @click="clickArea('龍潭區')"
                            coords="156,222,164,221,166,216,171,208,176,202,180,198,179,195,177,189,172,189,170,184,173,180,173,174,170,168,166,173,167,184,162,181,162,176,160,174,154,170,146,168,138,167,132,168,126,170,122,175,116,177,116,184,112,189,110,192,120,197,144,216" style="outline:none;" target="_self" />
                        <area alt="八德區" title="八德區" shape="poly" @click="clickArea('八德區')"
                            coords="198,154,204,148,212,146,216,144,218,138,222,137,222,130,220,121,214,116,209,114,206,118,208,123,205,124,201,122,198,118,195,114,192,110,188,113,185,118,183,128,184,137,181,141,178,145,176,151,184,153,186,144,193,150" style="outline:none;" target="_self" />
                        <area alt="平鎮區" title="平鎮區" shape="poly" @click="clickArea('平鎮區')"
                            coords="164,173,168,166,172,158,172,152,170,148,163,144,158,138,156,129,151,125,144,125,138,121,136,120,139,114,133,113,132,120,128,124,132,133,134,142,131,149,133,158,130,161,137,166,146,165,156,170" style="outline:none;" target="_self" />
                        <area alt="中壢區" title="中壢區" shape="poly" @click="clickArea('中壢區')"
                            coords="171,145,179,138,181,131,181,112,177,107,177,100,174,95,168,90,161,94,162,90,162,86,157,83,156,84,154,94,151,90,150,82,146,78,141,77,138,81,135,77,130,76,125,77,122,77,120,86,124,97,122,105,119,113,116,118,124,120,130,123,132,118,136,114,141,120,149,122,158,129,158,136" style="outline:none;" target="_self" />
                        <area alt="桃園區" title="桃園區" shape="poly" @click="clickArea('桃園區')"
                            coords="203,124,205,116,208,112,214,113,221,115,222,109,226,104,228,98,225,88,224,81,217,78,208,77,201,78,196,78,192,87,189,96,187,102,180,104,181,114,188,112,189,109,197,108,199,117" style="outline:none;" target="_self" />
                        <area alt="龜山區" title="龜山區" shape="poly" @click="clickArea('龜山區')"
                            coords="224,118,243,121,259,121,265,112,272,113,272,103,275,97,282,93,276,89,274,80,272,70,269,66,265,61,257,61,251,57,244,58,237,58,229,67,222,69,216,70,210,72,217,78,225,82,228,91,231,100,228,105,222,109" style="outline:none;" target="_self" />
                        <area alt="蘆竹區" title="蘆竹區" shape="poly" @click="clickArea('蘆竹區')"
                            coords="183,103,190,97,190,88,192,80,195,74,202,77,208,73,206,70,207,68,220,70,233,64,238,57,238,52,244,48,237,45,229,42,225,36,216,32,210,30,206,26,200,15,190,13,180,15,174,16,184,25,185,41,190,53,182,57,172,70,170,79,178,88,177,96" style="outline:none;" target="_self" />
                        <area alt="大園區" title="大園區" shape="poly" @click="clickArea('大園區')"
                            coords="153,82,165,86,169,83,168,73,185,52,187,46,184,40,181,29,178,18,173,16,164,20,153,22,144,30,137,30,127,34,116,36,118,52,123,62,121,72,130,73,140,74" style="outline:none;" target="_self" />
                        <area alt="觀音區" title="觀音區" shape="poly" @click="clickArea('觀音區')"
                            coords="114,114,120,103,120,90,118,85,118,73,122,63,117,56,116,50,113,38,102,38,92,38,85,44,76,46,71,51,61,58,54,64,43,72,57,72,65,84,75,89,86,96,97,92,100,100" style="outline:none;" target="_self" />
                        <area alt="新屋區" title="新屋區" shape="poly" @click="clickArea('新屋區')"
                            coords="10,117,22,100,29,85,35,77,54,73,60,81,68,88,82,97,95,94,104,96,105,108,112,117,112,124,102,125,94,120,90,125,82,120,75,116,69,122,59,125,54,128,43,123,29,118" style="outline:none;" target="_self" />
                        <area alt="楊梅區" title="楊梅區" shape="poly" @click="clickArea('楊梅區')"
                            coords="113,173,125,170,130,162,130,149,133,138,130,130,122,123,117,122,105,126,94,125,84,125,77,119,67,122,57,126,54,132,54,144,68,148,76,153,85,151,88,162" style="outline:none;" target="_self" />
                    </map>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    name: 'district-back',
    props: {
        years: Array
    },
    data: function() {
        return {
            showMap: false,
            year: '',
            area: '',
            title: '',
            content: ''
        };
    },
    watch: {
        year: function() {
            this.showMap = true;
        }
    },
    methods: {
        // district, 新增學年
        addYear() {
          let vobj = this;

          axios.post('/district/addYear').then(
            (response) => {
              location.reload();
            }
          );
        },
        clickArea(area) {
            this.area = area;

            if (!this.year) {
                alert('請選擇學年度');
            } else {
                let vobj = this;
                vobj.title = vobj.year + '學年' + vobj.area;
                axios.get('/district/' + vobj.year + '/' + area).then(
                    (response) => {
                        vobj.content = response.data.content;
                    }
                );
                $('#model-district').modal('toggle');
            }
        },
        submit() {
            axios.post('/district', {
                year: this.year,
                area: this.area,
                content: this.content
            }).then(
                (response) => {
                    alert('更新完成');
                }
            );
        }
    }
}
</script>