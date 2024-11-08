package com.sample.matiran.tools.network.entity

import com.google.gson.annotations.SerializedName

class CryptoListResponseEntity(
    @SerializedName("data")
    val cryptoList: List<CryptoEntity>?
)