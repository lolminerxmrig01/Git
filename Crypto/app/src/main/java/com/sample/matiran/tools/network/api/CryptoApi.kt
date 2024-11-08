package com.sample.matiran.tools.network.api

import com.sample.matiran.tools.network.entity.CryptoListResponseEntity
import retrofit2.http.GET

//define retrofit api
interface CryptoApi {

    @GET("api/digital-money")
    suspend fun getCryptoList(): CryptoListResponseEntity
}