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
  TouchableHighlight,
} from 'react-native';
import React, {useState, useEffect} from 'react';
// import AsyncStorage from '@react-native-async-storage/async-storage';
import RNFetchBlob from 'rn-fetch-blob'; //Libarary Untuk mengirim File dengan API
import User from '../../../assets/icons/user';
import Svgicon from '../../../assets/icons/Svgicon';
import Deskripsiabsen from './TitleDesk';
import ImageCamera from './ImageCamera';
import {APIDOMAINWEB} from '../../../assets/containt';
import {showToastWithGravityAndOffset} from '../../../assets/_Toasview';
const {width: WIDTH} = Dimensions.get('window');
const {height: HEIGHT} = Dimensions.get('window');
//-----Conditions
import AsyncStorage from '@react-native-async-storage/async-storage';
import moment from 'moment-timezone';
import Geolocation from '@react-native-community/geolocation';
import {getDistance, getPreciseDistance} from 'geolib';

const Index = props => {
  const [state, setState] = useState(false);
  const [loadStatus, setLoadStatus] = useState(false);
  const [sincreonStatus, setSincreonStatus] = useState(false);
  const getUserData = async () => {
    let dataUser = JSON.parse(await AsyncStorage.getItem('Json_Login'));
    let dataImages = JSON.parse(await AsyncStorage.getItem('Json_Storage'));
    setState({user: dataUser, dataImage: dataImages});
    setState(state => {
      return {
        ...state,
        LoadingUpload: false,
      };
    });
  };
  const Formula_Jadwal_masuk = async () => {
    let masuk = state.JmasukState;
    let masukEnd = state.JmasukEndState;
    let toler = state.ToleransiState;
    let val = 'Log';
    if (masuk) {
      val = 'Jam Absen Belum Masuk ';
      console.log('================Masuk State====================');
      console.log('pesan' + val);
      console.log('Displin:' + 0);
      console.log('====================================');
      setState(state => {
        return {
          ...state,
          MasukState: {
            pesan: val,
            Displin: '0',
            state: false,
          },
        };
      });
    } else {
      if (masukEnd) {
        val = 'Silahkan Ambil Absen Masuk Pada Jam Ini';
        console.log('================Masuk State====================');
        console.log('pesan' + val);
        console.log('Displin:' + 1);
        console.log('====================================');
        setState(state => {
          return {
            ...state,
            MasukState: {
              pesan: val,
              Displin: '1',
              state: false,
            },
          };
        });
      } else {
        if (toler) {
          val = 'Terlambat';
          console.log('================Masuk State====================');
          console.log('pesan' + val);
          console.log('Displin:' + 0);
          console.log('====================================');
          setState(state => {
            return {
              ...state,
              MasukState: {
                pesan: val,
                Displin: '0',
                state: false,
              },
            };
          });
        } else {
          val = 'Anda Masuk Diluar Jam Ketentuan';
          console.log('================Masuk State====================');
          console.log('pesan' + val);
          console.log('Displin:' + 0);
          console.log('====================================');
          setState(state => {
            return {
              ...state,
              MasukState: {
                pesan: val,
                Displin: '0',
                state: false,
              },
            };
          });
        }
      }
    }

    Formula_Jadwal_Pulang();
  };
  const Formula_Jadwal_Pulang = async () => {
    let pulang = state.JpulangState;
    let pulangEnd = state.JpulangEndState;
    let val = 'Log';
    if (pulang) {
      val = 'Jam Absen Belum Pulang ';
      // this.setState({
      //   PulangState: {
      //     pesan: val,
      //     state: false,
      //   },
      // });
      setState(state => {
        return {
          ...state,
          PulangState: {
            pesan: val,
            state: false,
          },
        };
      });
    } else {
      if (pulangEnd) {
        val = 'Silahkan Ambil Absen PULANG Pada Jam Ini';
        // this.setState({
        //   PulangState: {
        //     pesan: val,
        //     state: true,
        //   },
        // });
        setState(state => {
          return {
            ...state,
            PulangState: {
              pesan: val,
              state: false,
            },
          };
        });
      } else {
        val = 'Anda Pulang Diluar Jam Ketentuan';
        // this.setState({
        //   PulangState: {
        //     pesan: val,
        //     state: false,
        //   },
        // });
        setState(state => {
          return {
            ...state,
            PulangState: {
              pesan: val,
              state: false,
            },
          };
        });
      }
    }
  };
  const ProseJadwal = () => {
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
      // setState({ ...state, TanggalNow: tgl });
      setState(state => {
        return {
          ...state,
          TanggalNow: tgl,
        };
      });
    };
    const Formula_Jam = e => {
      //NOW------
      let now = moment().tz('Asia/Jakarta').format('HH:mm:ss');
      let jamNow = JSON.stringify(now);

      setState(state => {
        return {
          ...state,
          jamNowID: now,
        };
      });
      let H_now = 0;
      let M_now = 0;
      H_now = jamNow.split(':')[0];
      M_now = jamNow.split(':')[1];
      //From Base------
      let Get_timefrombase = moment(e, 'hh:mm:ss', false)
        .tz('Asia/Jakarta')
        .format('HH:mm');
      let jamData = JSON.stringify(Get_timefrombase);
      let H_Get = 0;
      let M_Get = 0;
      H_Get = jamData.split(':')[0];
      M_Get = jamData.split(':')[1];

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

    let GetDataFromDB = async () => {
      fetch(APIDOMAINWEB + '/AuthApp/JadwalCek', {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          IDkaryawan: state.user.IDkaryawan,
        }),
      })
        .then(response => {
          return response.json();
        })
        .then(responseJson => {
          if (responseJson.respond) {
            setState(state => {
              return {...state, jadwalJSON: responseJson.data};
            });
            setState(state => {
              return {...state, Jsift: responseJson.data.ket_waktu};
            });
            setState(state => {
              return {...state, Jlokasi: responseJson.data.lokasi};
            });
            setState(state => {
              return {
                ...state,
                JKordinat: {
                  la: responseJson.data.latitude,
                  lo: responseJson.data.longitude,
                },
              };
            });
            setState(state => {
              return {
                ...state,
                Range: responseJson.data.range,
              };
            });
            setState(state => {
              return {
                ...state,
                Jmasuk: responseJson.data.waktu_mulai_masuk,
              };
            });

            tanggalSekarang();

            setState(state => {
              return {
                ...state,
                JmasukEnd: responseJson.data.waktu_selesai_masuk,
              };
            });
            setState(state => {
              return {
                ...state,
                Toleransi: responseJson.data.toleransi,
              };
            });
            setState(state => {
              return {
                ...state,
                Jpulang: responseJson.data.waktu_mulai_keluar,
              };
            });
            setState(state => {
              return {
                ...state,
                JpulangEnd: responseJson.data.waktu_selesai_keluar,
              };
            });
            const kondisiMasuk = Formula_Jam(
              responseJson.data.waktu_selesai_masuk,
            );
            console.log(
              '==============Kondisi Selesai Masuk======================',
            );
            console.log('state: ' + kondisiMasuk);
            console.log(
              'Waktu Selesai Masuk: ' + responseJson.data.waktu_selesai_masuk,
            );
            console.log('====================================');
            setState(state => {
              return {
                ...state,
                JmasukEndState: kondisiMasuk,
              };
            });
            //----

            setState(state => {
              return {
                ...state,
                JpulangState: Formula_Jam(responseJson.data.waktu_mulai_keluar),
              };
            });

            setState(state => {
              return {
                ...state,
                JpulangEndState: Formula_Jam(
                  responseJson.data.waktu_selesai_keluar,
                ),
              };
            });

            setState(state => {
              return {
                ...state,
                JmasukState: Formula_Jam(responseJson.data.waktu_mulai_masuk),
              };
            });
            setState(state => {
              return {
                ...state,
                ToleransiState: Formula_Jam(responseJson.data.toleransi),
              };
            });
            let d = responseJson.data.status_kehadiran;
            if ((d != 0) & (d != null)) {
              if (d == 'm') {
                // this.setState({StatusKehadiran: 'Masuk (Belum Pulang)'});
                setState(state => {
                  return {
                    ...state,
                    StatusKehadiran: 'Masuk (Belum Pulang)',
                  };
                });
              } else if (d == 'i') {
                // this.setState({StatusKehadiran: 'Izin Tidak Masuk'});
                setState(state => {
                  return {
                    ...state,
                    StatusKehadiran: 'Izin Tidak Masuk',
                  };
                });
              } else if (d == 's') {
                //this.setState({StatusKehadiran: 'Sakit'});
                setState(state => {
                  return {
                    ...state,
                    StatusKehadiran: 'Sakit',
                  };
                });
              } else {
                // this.setState({StatusKehadiran: 'Hadir (Sudah Pulang)'});
                setState(state => {
                  return {
                    ...state,
                    StatusKehadiran: 'Hadir (Sudah Pulang)',
                  };
                });
              }
            } else {
              //this.setState({StatusKehadiran: 'Alfa'});
              setState(state => {
                return {
                  ...state,
                  StatusKehadiran: 'Alfa',
                };
              });
            }
            console.log('Kondisi Pulang');
            console.log(state.PulangState);

            showToastWithGravityAndOffset('Jadwal Succes diambil :D ');
          } else {
            console.log('Jadwal Anda Belum di SET');
            setState(state => {
              return {
                ...state,
                LoadingState: false,
              };
            });

            setState(state => {
              return {
                ...state,
                Notifikasi: {state: true, pesan: responseJson.Pesan},
              };
            });
          }
        })
        .catch(error => {
          console.log('Gagal cek jadwal !!!!');
          console.error(error);
        });
    };

    GetDataFromDB();
    //cange loas status before
    if (!state.la && state.JKordinat) {
      console.log('===============Aambil Lokasi X=====================');
      console.log(state.JKordinat);
      console.log('====================================');
      Getlokas();
      setState(state => {
        return {
          ...state,
          LoadingState: false,
        };
      });
      setLoadStatus(true);
    }
  };
  let KirimBlob = async () => {
    const locaLurl = APIDOMAINWEB + '/Triger/Absen/';
    const body = [
      {
        name: 'imagos',
        filename: state.dataImage.fileName,
        type: 'image/jpeg',
        data: state.dataImage.base64,
      }, //PPOST FILE dengan "name" sebagai variabel utama
      {name: 'ID', data: state.user.IDkaryawan},
      {name: 'NamaKaryawan', data: state.user.namakaryawan},
      {name: 'StatusAbsen', data: 'Masuk'},
      {name: 'id_jadwal', data: state.jadwalJSON.id_jadwal},
      {name: 'jam_Capture', data: state.jamNowID},
      {name: 'Displin', data: state.MasukState.Displin},
      {name: 'la', data: state.la.toString()},
      {name: 'lo', data: state.lo.toString()},
    ];
    console.log('=============Value Body=======================');
    console.log(body);
    console.log('====================================');
    console.log('====================================');
    console.log(state.MasukState);
    console.log('====================================');
    await RNFetchBlob.fetch(
      'POST',
      locaLurl,
      {
        Authorization: 'Bearer access-token',
        otherHeader: 'foo',
        'Content-Type': 'multipart/form-data',
      },
      body,
    )
      .then(response => {
        const r = JSON.parse(response.data);
        if (r.Respond == true) {
          console.log('Bisa');
          // this.setState({LoadingUpload: true});
          setState(state => {
            return {
              ...state,
              LoadingUpload: true,
            };
          });
          setTimeout(() => {
            // this.setState({LoadingUpload: !state.LoadingUpload});
            setState(state => {
              return {
                ...state,
                LoadingUpload: !state.LoadingUpload,
              };
            });
            props.navigation.navigate('Home');
          }, 5000);
          console.log(r);
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
  let InserttoSQL = async () => {
    setTimeout(async () => {
      await Formula_Jadwal_masuk();
      await setSincreonStatus(true);
      showToastWithGravityAndOffset('Gambar berhasil disimpan');
    }, 2000);
  };
  let Getlokas = async () => {
    await Geolocation.getCurrentPosition(info => {
      var dis = getDistance(
        {latitude: info.coords.latitude, longitude: info.coords.longitude}, //kordinat sekarang
        {
          latitude: state.JKordinat.la,
          longitude: state.JKordinat.lo,
        }, //kordinat SET
      );
      // this.setState({Jarak: dis});
      setState(state => {
        return {
          ...state,
          Jarak: dis,
        };
      });
      // this.setState({la: info.coords.latitude, lo: info.coords.longitude});
      setState(state => {
        return {
          ...state,
          la: info.coords.latitude,
          lo: info.coords.longitude,
        };
      });
      var disP = getPreciseDistance(
        {latitude: info.coords.latitude, longitude: info.coords.longitude},
        {
          latitude: state.JKordinat.la,
          longitude: state.JKordinat.lo,
        },
      );
      // this.setState({Pjarak: disP});
      setState(state => {
        return {
          ...state,
          Pjarak: disP,
        };
      });
    });
  };
  let GoBackAndReClickCamera = async () => {
    await props.navigation.goBack();
  };
  useEffect(() => {
    if (!state.user) {
      console.log('Load Asyncronouse Data ');
      showToastWithGravityAndOffset('Load Asyncronouse Data . . .');
      getUserData();
    } else {
      if (!loadStatus) {
        ProseJadwal();
      } else {
      }
    }
  });
  let ReviewCapturePages = () => {
    if (loadStatus) {
      return (
        <View style={styles.container}>
          <View style={styles.Textcontainer}>
            <TouchableOpacity
              style={styles.backButton}
              onPress={() => {
                console.log('Back was Click');
                GoBackAndReClickCamera();
              }}>
              <Svgicon key={987} name="Back" color="black" />
            </TouchableOpacity>
            <Deskripsiabsen />
            <ImageCamera ShootTime={state.jamNow + '' + state.TanggalNow} />
          </View>
          <View style={styles.ButtonBox}>
            <TouchableOpacity
              onPress={() => {
                if (sincreonStatus) {
                  KirimBlob();
                } else {
                  InserttoSQL();
                }
              }}
              style={styles.FormButton}>
              <Text style={styles.FormButtonLable}>
                {sincreonStatus ? 'Masuk' : 'Simpan'}
              </Text>
            </TouchableOpacity>
            <TouchableOpacity
              disabled={sincreonStatus}
              onPress={() => GoBackAndReClickCamera()}
              style={[
                styles.FormButtonChancel,
                {opacity: sincreonStatus ? 0.1 : 1},
              ]}>
              <Text style={styles.FormButtonLableChancel}>Ulangi</Text>
            </TouchableOpacity>
          </View>
        </View>
      );
    } else {
      return <View></View>;
    }
  };
  return (
    <View style={styles.Backcontainer}>
      {<ReviewCapturePages key={765} />}
      {
        <Modal
          animationType={'slide'}
          transparent={true}
          visible={state.LoadingState}
          onRequestClose={() => {
            console.log('Modal has been closed.');
          }}>
          <View style={styles.modal}>
            <Text style={styles.labelmodal}>Load . . .</Text>

            <TouchableHighlight
              onPress={() => {
                // this.setState({ LoadingState: !state.LoadingState });
                setState(state => {
                  return {...state, LoadingState: !state.LoadingState};
                });
              }}>
              <Text style={styles.labelmodal}>X</Text>
            </TouchableHighlight>
          </View>
        </Modal>
      }
      {
        <Modal
          animationType={'slide'}
          transparent={true}
          visible={state.LoadingUpload}
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
};

export default Index;

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
  Backcontainer: {
    flex: 1,
    alignItems: 'center',
  },
  backButton: {
    backgroundColor: 'rgba(50,50,50,0.1)',
    borderRadius: 50,
    top: -15,
    left: -15,
    width: 70,
    height: 70,
    alignItems: 'center',
    justifyContent: 'center',
  },
  container: {
    top: 20,
    width: WIDTH - 30,
    alignItems: 'flex-start',
    // backgroundColor:'grey',
    // borderColor:'black',
    // borderWidth:1,
  },
  Textcontainer: {
    width: '100%',
    paddingBottom: 20,
    // backgroundColor:'grey'
  },
  FormButtonChancel: {
    height: 50,
    width: '40%',
    marginRight: 60,
    backgroundColor: '#FFFFFF',
    borderColor: '#359EFF',
    borderWidth: 1,
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
  FormButton: {
    height: 50,
    width: '40%',
    marginRight: 60,
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
  FormButtonLable: {
    fontFamily: 'Raleway-Bold',
    fontSize: 20,
    color: 'rgba(255,255,255,1)',
  },
  FormButtonLableChancel: {
    fontFamily: 'Raleway-Bold',
    fontSize: 20,
    color: '#359EFF',
  },
  ButtonBox: {
    // borderColor:'red',
    padding: 20,
    // borderWidth:1,
    width: '100%',
    height: 80,
    flexWrap: 'wrap-reverse',
    justifyContent: 'center',
  },
});
