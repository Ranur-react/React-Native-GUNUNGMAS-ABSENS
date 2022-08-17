/* @flow */

import React, {Component} from 'react';
import {
  View,
  Text,
  StyleSheet,
  Dimensions,
  TextInput,
  Alert,
  TouchableOpacity,
  Svg,
  Keyboard,
  TouchableWithoutFeedback,
  ScrollView,
  Button,
  Modal,
  Platform,
} from 'react-native';
import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';
import Deskripsiabsen from './TitleDesk';
import Camera from './Camera';
import UploadBox from './testUpload';
import DatePicker from 'react-native-datepicker';
import DocumentPicker from 'react-native-document-picker';
import {APIDOMAINWEB} from './../../assets/containt';
import {showToastWithGravityAndOffset} from './../../assets/_Toasview';
import moment from 'moment-timezone';
import AsyncStorage from '@react-native-async-storage/async-storage';
import RNFetchBlob from 'rn-fetch-blob'; //Libarary Untuk mengirim File dengan API
import RNFS from 'react-native-fs';
import Geolocation from '@react-native-community/geolocation';
import {getDistance, getPreciseDistance} from 'geolib';
var IPSERVER = null;

const {width: WIDTH} = Dimensions.get('window');
const {height: HEIGHT} = Dimensions.get('window');

export default class Sakit extends Component {
  constructor(props) {
    var a = new Date();

    super(props);
    this.state = {
      date: a.toISOString().slice(0, 10),
      user: '',
      jadwalJSON: '',
      LoadingState: true,
      LoadingUpload: false,
    };
  }
  ProseJadwal = () => {
    const tanggalSekarang = () => {
      var months = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
      ];
      var myDays = [
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jum&#39;at',
        'Sabtu',
      ];
      var date = new Date();
      var month = date.getMonth();
      var day = date.getDate();
      var thisDay = date.getDay(),
        thisDay = myDays[thisDay];
      var yy = date.getYear();
      var year = yy < 1000 ? yy + 1900 : yy;
      let tgl = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
      this.setState({TanggalNow: tgl});
    };
    let Getlokas = async () => {
      await Geolocation.getCurrentPosition(info => {
        var dis = getDistance(
          {latitude: info.coords.latitude, longitude: info.coords.longitude}, //kordinat sekarang
          {
            latitude: this.state.JKordinat.la,
            longitude: this.state.JKordinat.lo,
          }, //kordinat SET
        );
        this.setState({Jarak: dis});
        this.setState({la: info.coords.latitude, lo: info.coords.longitude});
        var disP = getPreciseDistance(
          {latitude: info.coords.latitude, longitude: info.coords.longitude},
          {
            latitude: this.state.JKordinat.la,
            longitude: this.state.JKordinat.lo,
          },
        );
        this.setState({Pjarak: disP});
      });
    };
    const Formula_Jam = e => {
      //NOW------
      let now = moment().tz('Asia/Jakarta').format('HH:mm:ss');
      this.setState({jamNow: JSON.stringify(now)});
      this.setState({jamNowID: now});

      let H_now = 0;
      let M_now = 0;
      H_now = this.state.jamNow.split(':')[0];
      M_now = this.state.jamNow.split(':')[1];
      //From Base------
      let Get_timefrombase = moment(e, 'hh:mm:ss', false)
        .tz('Asia/Jakarta')
        .format('HH:mm');
      this.setState({jamData: JSON.stringify(Get_timefrombase)});
      let H_Get = 0;
      let M_Get = 0;
      H_Get = this.state.jamData.split(':')[0];
      M_Get = this.state.jamData.split(':')[1];

      if (H_now <= H_Get) {
        if (H_now == H_Get) {
          // console.log("Jam sama"+H_Get);
          if (M_now < M_Get) return true;
          else return false;
        } else {
          return true;
        }
      } else {
        return false;
      }
    };
    const Formula_Jadwal_masuk = () => {
      let masuk = this.state.JmasukState;
      let masukEnd = this.state.JmasukEndState;
      let toler = this.state.ToleransiState;
      let val = 'Log';
      if (masuk) {
        val = 'Jam Absen Belum Masuk ';
        this.setState({
          MasukState: {
            pesan: val,
            state: false,
          },
        });
      } else {
        if (masukEnd) {
          val = 'Silahkan Ambil Absen Masuk Pada Jam Ini';
          this.setState({
            MasukState: {
              pesan: val,
              Displin: '1',
              state: true,
            },
          });
        } else {
          if (toler) {
            val = 'Terlambat';
            this.setState({
              MasukState: {
                pesan: val,
                Displin: '0',
                state: true,
              },
            });
          } else {
            val = 'Anda Masuk Diluar Jam Ketentuan';
            this.setState({
              MasukState: {
                Displin: '0',
                pesan: val,
                state: false,
              },
            });
          }
        }
      }

      Formula_Jadwal_Pulang();
    };
    const Formula_Jadwal_Pulang = async () => {
      let pulang = this.state.JpulangState;
      let pulangEnd = this.state.JpulangEndState;
      let val = 'Log';
      Getlokas();
      if (pulang) {
        val = 'Jam Absen Belum Pulang ';
        this.setState({
          PulangState: {
            pesan: val,
            state: false,
          },
        });
      } else {
        if (pulangEnd) {
          val = 'Silahkan Ambil Absen PULANG Pada Jam Ini';
          this.setState({
            PulangState: {
              pesan: val,
              state: true,
            },
          });
        } else {
          val = 'Anda Pulang Diluar Jam Ketentuan';
          this.setState({
            PulangState: {
              pesan: val,
              state: false,
            },
          });
        }
      }
    };
    let GetDataFromDB = async () => {
      fetch(APIDOMAINWEB + '/AuthApp/JadwalCek', {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
          'Cache-Control': 'no-cache',
        },
        body: JSON.stringify({
          IDkaryawan: this.state.user.IDkaryawan,
        }),
      })
        .then(response => response.json())
        .then(responseJson => {
          if (responseJson.respond) {
            this.setState({jadwalJSON: responseJson.data});
            this.setState({Jsift: responseJson.data.ket_waktu});
            this.setState({Jlokasi: responseJson.data.lokasi});
            this.setState({
              JKordinat: {
                la: responseJson.data.latitude,
                lo: responseJson.data.longitude,
              },
            });
            this.setState({Range: responseJson.data.range});
            tanggalSekarang();
            //---Masuk
            this.setState({Jmasuk: responseJson.data.waktu_mulai_masuk});
            //---Berakhirmasuk
            this.setState({JmasukEnd: responseJson.data.waktu_selesai_masuk});
            //---BatasTerlambat
            this.setState({Toleransi: responseJson.data.toleransi});

            this.setState({Jpulang: responseJson.data.waktu_mulai_keluar});

            this.setState({JpulangEnd: responseJson.data.waktu_selesai_keluar});

            this.setState({
              JmasukEndState: Formula_Jam(
                responseJson.data.waktu_selesai_masuk,
              ),
            });
            this.setState({
              ToleransiState: Formula_Jam(responseJson.data.toleransi),
            });
            this.setState({
              JpulangState: Formula_Jam(responseJson.data.waktu_mulai_keluar),
            });
            this.setState({
              JpulangEndState: Formula_Jam(
                responseJson.data.waktu_selesai_keluar,
              ),
            });
            this.setState({
              JmasukState: Formula_Jam(responseJson.data.waktu_mulai_masuk),
            });
            Formula_Jadwal_masuk();

            let d = responseJson.data.status_kehadiran;
            if ((d != 0) & (d != null)) {
              if (d == 'm') {
                this.setState({StatusKehadiran: 'Masuk (Belum Pulang)'});
              } else if (d == 'i') {
                this.setState({StatusKehadiran: 'Izin Tidak Masuk'});
              } else if (d == 's') {
                this.setState({StatusKehadiran: 'Sakit'});
              } else {
                this.setState({StatusKehadiran: 'Hadir (Sudah Pulang)'});
              }
            } else {
              this.setState({StatusKehadiran: 'Alfa'});
            }
            console.log('Kondisi Pulang');
            console.log(this.state.PulangState);
            this.setState({LoadingState: false});
          } else {
            console.log('Jadwal Anda Belum di SET');
            this.setState({LoadingState: false});

            this.setState({
              Notifikasi: {state: true, pesan: responseJson.Pesan},
            });
          }
        })
        .catch(error => {
          console.log('Gagal cek jadwal !!!!');
          console.error(error);
        });
    };
    GetDataFromDB();
  };
  UNSAFE_componentWillMount() {
    const getDataLoginJson = async () => {
      try {
        const jsonValue = await AsyncStorage.getItem('Json_Login');
        const data = JSON.parse(jsonValue);
        this.setState({user: data});
        console.log(!data.status);
        if (!data.status) {
          console.log('Gk Ada User');
        } else {
          console.log('Ada User');
          this.ProseJadwal();
        }
        showToastWithGravityAndOffset('data user didapatkan');
      } catch (e) {
        showToastWithGravityAndOffset(e.toString());
      }
    };
    getDataLoginJson();

    //
    if (this.state.LoadingState) {
      console.log('Loading State Dipanggil');
    }
  }
  InserttoSQL = async () => {
    console.log('mulai  upload');
    console.log('mulai  cek session');

    console.log(this.state.user);
    // const data = new FormData();
    const locaLurl = APIDOMAINWEB + '/Triger/Absen/Sakit';
    let KirimBlob = async () => {
      console.log('ID wan----->');
      console.log(this.state.user.IDkaryawan);
      await RNFetchBlob.fetch(
        'POST',
        locaLurl,
        {
          Authorization: 'Bearer access-token',
          otherHeader: 'foo',
          'Content-Type': 'multipart/form-data',
        },
        [
          {
            name: 'Suratos',
            filename: this.state.DocName,
            data: this.state.DocUri,
          }, //PPOST FILE dengan "name" sebagai variabel utama
          {name: 'ID', data: this.state.user.IDkaryawan},
          {name: 'NamaKaryawan', data: this.state.user.namakaryawan},
          {name: 'StatusAbsen', data: 'Sakit'},
          {name: 'id_jadwal', data: this.state.jadwalJSON.id_jadwal},
        ],
      )
        .then(response => {
          const r = JSON.parse(response.data);
          console.log(r.Respond);
          if (r.Respond == true) {
            //   console.log("Bisa");
            //   this.setState({LoadingUpload:true})
            //   setTimeout(()=>{
            //     this.setState({LoadingUpload:!this.state.LoadingUpload})
            this.props.navigation.navigate('Home');
            //   }
            //   ,5000);
            //   console.log(r );
            //
          } else {
            console.log('Gagal');
            console.log(r);
          }
        })
        .catch(e => {
          console.log('Terjadi Eror');
          console.log(e);
        });
    };
    KirimBlob();
  };
  render() {
    const selectOneFile = async () => {
      try {
        const respond = await DocumentPicker.pick({
          type: [DocumentPicker.types.pdf],
        });
        let res = respond[0];
        console.log(res);
        const filePath =
          Platform.OS === 'android' ? res.uri : res.uri.replace('file://', '');
        const EnCodFile = await RNFS.readFile(filePath, 'base64');
        this.setState({DocUri: EnCodFile});
        console.log('URI : ' + res.fileCopyUri);
        console.log('Type : ' + res.type);
        this.setState({DocType: res.type});
        this.setState({DocName: res.name});
        console.log('Isi Semua Tentang Dok:');
        // console.log(res);
      } catch (err) {
        if (DocumentPicker.isCancel(err)) {
          alert('Anda Belum mengambil Files');
        } else {
          alert('Unknown Error: ' + JSON.stringify(err));
          throw err;
        }
      }
    };
    return (
      <View style={styles.Backcontainer}>
        <View style={styles.container}>
          <TouchableOpacity
            style={styles.backButton}
            onPress={() => this.props.navigation.goBack()}>
            <Svgicon name="Back" color="black" />
          </TouchableOpacity>
          <View style={styles.Title}>
            <Text onPress={() => Keyboard.dismiss()} style={styles.JudulBld}>
              Izin Sakit
            </Text>
          </View>

          <View style={styles.FormBox}>
            <View style={styles.Form}>
              <Text style={styles.Label}>Tanggal Sekarang</Text>
              <DatePicker
                style={styles.FormInputDate}
                date={this.state.date}
                mode="date"
                placeholder="select date"
                format="YYYY-MM-DD"
                minDate="2018-01-01"
                disabled={true}
                maxDate="2022-12-31"
                confirmBtnText="Confirm"
                cancelBtnText="Cancel"
                customStyles={{
                  dateIcon: {
                    position: 'absolute',
                    left: 0,
                    top: 4,
                    marginLeft: 0,
                  },
                  dateInput: {
                    marginLeft: 36,
                    marginRight: 240,
                    borderWidth: 0,
                    top: 0,
                  },
                  dateText: {
                    fontFamily: 'Raleway-Medium',

                    fontSize: 16,
                  },
                }}
                onDateChange={date => {
                  this.setState({date: date});
                }}
              />
              <Text style={styles.NotofikasiInput}></Text>
            </View>
            <View style={styles.Form}>
              <Text style={styles.Label}>Keterangan</Text>
              <TextInput
                style={styles.FormInput}
                placeholder="Tulis keterangan sakit mu disini "
              />
              <Text style={styles.NotofikasiInput}></Text>
            </View>
            <TouchableOpacity onPress={selectOneFile}>
              <UploadBox filename={this.state.DocName} />
            </TouchableOpacity>
            <TouchableOpacity
              onPress={this.InserttoSQL}
              style={styles.FormButton}>
              <Text style={styles.FormButtonLable}>Kirim </Text>
            </TouchableOpacity>
            <TouchableOpacity style={styles.FormButtonWhite}>
              <Text style={styles.FormButtonLableChancel}>Batal</Text>
            </TouchableOpacity>
          </View>
        </View>
        {
          <Modal
            animationType={'slide'}
            transparent={true}
            visible={this.state.LoadingState}
            onRequestClose={() => {
              console.log('Modal has been closed.');
            }}>
            <View style={styles.modal}>
              <Text style={styles.labelmodal}>Load . . .</Text>
            </View>
          </Modal>
        }
        {
          <Modal
            animationType={'slide'}
            transparent={true}
            visible={this.state.LoadingUpload}
            onRequestClose={() => {
              console.log('Modal has been closed.');
            }}>
            <View style={styles.modal}>
              <Text style={styles.labelmodal}>Upload Foto . . .</Text>
            </View>
          </Modal>
        }
      </View>
    );
  }
}

const styles = StyleSheet.create({
  modal: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: 'rgba(76,169,255,0.6)',
    padding: 100,
  },
  labelmodal: {
    textAlign: 'center',
    fontFamily: 'Raleway-Bold',
    fontSize: 20,
    color: 'rgba(255,255,255,1)',
  },
  FormButtonLableChancel: {
    fontFamily: 'Raleway-Bold',
    fontSize: 20,
    color: '#359EFF',
  },
  Backcontainer: {
    flex: 1,
    alignItems: 'center',
  },
  backButton: {
    backgroundColor: 'rgba(50,50,50,0)',
    borderRadius: 50,
    top: -15,
    left: -15,
    width: 70,
    height: 70,
    alignItems: 'center',
    justifyContent: 'center',
  },
  Icon: {
    position: 'absolute',
    top: 26,
    left: 24,
  },
  container: {
    top: 20,
    width: WIDTH - 30,
    // backgroundColor:'grey',
    // borderColor:'black',
    // borderWidth:1,
  },
  Textcontainer: {
    width: '100%',
    paddingBottom: 20,
    // backgroundColor:'grey'
  },
  Title: {
    width: '100%',
    alignItems: 'center',
    top: 139,
  },
  JudulBld: {
    fontFamily: 'Raleway-Bold',
    fontSize: 35,
    lineHeight: 35,
  },
  FormBox: {
    paddingTop: 50,
    position: 'absolute',
    // backgroundColor: 'rgba(50,50,50,0.5)',
    width: WIDTH - 30,
    top: 230,
    flex: 1,
    flexDirection: 'column',
  },
  //
  Form: {
    flex: 1,
    width: '100%',
    marginBottom: 15,
  },
  Label: {
    fontFamily: 'Raleway-Medium',
    fontSize: 12,
    lineHeight: 11.74,
    paddingLeft: 20,
    paddingBottom: 5,
    color: 'black',
    letterSpacing: 1.3,
  },
  FormInput: {
    height: 50,
    width: '100%',
    paddingLeft: 20,
    borderColor: 'rgba(0,0,0,0.5)',
    borderRadius: 50,
    fontFamily: 'Raleway-Medium',
    fontSize: 16,
    borderWidth: 1,
    borderStyle: 'solid',
  },
  FormInputDate: {
    height: 50,
    width: '100%',
    paddingLeft: 20,
    borderColor: 'rgba(0,0,0,0.0)',
    borderRadius: 50,
    fontFamily: 'Raleway-Medium',
    fontSize: 16,
    borderWidth: 1,
    borderStyle: 'solid',
  },
  //
  FormButton: {
    height: 50,
    width: '100%',
    backgroundColor: '#359EFF',
    borderRadius: 50,
    alignItems: 'center',
    justifyContent: 'center',
    shadowColor: 'rgba(0,0,0,0.25)',
    shadowOffset: {
      width: 3,
      height: 10,
    },
    shadowOpacity: 0.03,
    shadowRadius: 50,
    elevation: 2,
  },
  FormButtonWhite: {
    height: 50,
    marginTop: 12,
    width: '100%',
    backgroundColor: '#FFFFFF',
    borderRadius: 50,
    borderWidth: 1,
    borderStyle: 'solid',
    borderColor: '#359EFF',
    alignItems: 'center',
    justifyContent: 'center',
  },
  FormButtonLable: {
    fontFamily: 'Raleway-Bold',
    fontSize: 20,
    color: 'rgba(255,255,255,1)',
  },
});
