package com.sample.matiran.repository

import androidx.lifecycle.MutableLiveData
import com.sample.matiran.model.Crypto
import com.sample.matiran.tools.base.BaseRepository
import com.sample.matiran.tools.extensions.Mapper
import com.sample.matiran.tools.extensions.asImmutable
import com.sample.matiran.tools.extensions.toCryptoList
import com.sample.matiran.tools.network.api.CryptoApi
import com.sample.matiran.tools.network.entity.CryptoEntity
import javax.inject.Inject
import javax.inject.Singleton

@Singleton
class CryptoRepository @Inject constructor(
    private val cryptoApi: CryptoApi,
    private val cryptoMapper: Mapper<CryptoEntity, Crypto>
) : BaseRepository() {

    private val _cryptoInfo = MutableLiveData<List<Crypto>>(listOf())
    val cryptoInfo = _cryptoInfo.asImmutable()

    suspend fun getCryptoList() {
        _cryptoInfo.value = cryptoApi.getCryptoList().toCryptoList(cryptoMapper)
    }

    fun getDetailCrypto(cryptoId: Int): Crypto? {
        return cryptoInfo.value?.find { it.id == cryptoId.toString()}
    }

}
