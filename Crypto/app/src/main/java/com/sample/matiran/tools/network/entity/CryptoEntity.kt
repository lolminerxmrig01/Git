package com.sample.matiran.tools.network.entity


import com.google.gson.annotations.Expose
import com.google.gson.annotations.SerializedName

  class CryptoEntity(
    @Expose
    @SerializedName("csupply")
    val csupply: String?,

    @Expose
    @SerializedName("id")
    val id: String?,

    @Expose
    @SerializedName("market_cap_usd")
    val marketCapUsd: String?,

    @Expose
    @SerializedName("msupply")
    val msupply: String?,

    @Expose
    @SerializedName("name")
    val name: String?,

    @Expose
    @SerializedName("nameid")
    val nameid: String?,

    @Expose
    @SerializedName("percent_change_1h")
    val percentChange1h: String?,

    @Expose
    @SerializedName("percent_change_24h")
    val percentChange24h: String?,

    @Expose
    @SerializedName("percent_change_7d")
    val percentChange7d: String?,

    @Expose
    @SerializedName("price_btc")
    val priceBtc: String?,

    @Expose
    @SerializedName("price_usd")
    val priceUsd: String?,

    @Expose
    @SerializedName("rank")
    val rank: String?,

    @Expose
    @SerializedName("symbol")
    val symbol: String?,

    @Expose
    @SerializedName("tsupply")
    val tsupply: String?,

    @Expose
    @SerializedName("volume24")
    val volume24: String?,

    @Expose
    @SerializedName("volume24a")
    val volume24a: Double?
)