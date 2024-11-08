package com.sample.matiran.viewmodel

import com.sample.matiran.repository.CryptoRepository
import com.sample.matiran.tools.base.BaseViewModel
import dagger.hilt.android.lifecycle.HiltViewModel
import javax.inject.Inject

@HiltViewModel
class ListViewModel @Inject constructor(
    private val cryptoRepository: CryptoRepository
) : BaseViewModel() {

    var isInitList : Boolean = false

    fun getCryptoList() {

        launchWithState(
            action = {cryptoRepository.getCryptoList()},
            finallyAction = {isInitList = true}
        )
    }

    fun getCurrentCryptoInfo() = cryptoRepository.cryptoInfo


}