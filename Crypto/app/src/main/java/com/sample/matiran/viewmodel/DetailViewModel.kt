package com.sample.matiran.viewmodel

import com.sample.matiran.model.Crypto
import com.sample.matiran.repository.CryptoRepository
import com.sample.matiran.tools.base.BaseViewModel
import dagger.hilt.android.lifecycle.HiltViewModel
import javax.inject.Inject

@HiltViewModel
class DetailViewModel @Inject constructor(
    private val cryptoRepository: CryptoRepository
) : BaseViewModel() {

    var isRootList : Boolean = false

    fun getDetailCryptoById(cryptoId: Int):Crypto? {
      return  cryptoRepository.getDetailCrypto(cryptoId)
    }
}