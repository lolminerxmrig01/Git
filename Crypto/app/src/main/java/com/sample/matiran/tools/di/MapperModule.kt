package com.sample.matiran.tools.di

import com.sample.matiran.model.Crypto
import com.sample.matiran.tools.extensions.Mapper
import com.sample.matiran.tools.network.entity.CryptoEntity
import dagger.Module
import dagger.Provides
import dagger.hilt.InstallIn
import dagger.hilt.components.SingletonComponent
import javax.inject.Singleton

@Module
@InstallIn(SingletonComponent::class)
object MapperModule {

    @Provides
    @Singleton
    fun provideCrypto(): Mapper<CryptoEntity, Crypto> =
        {
            Crypto(
                it.id ?: "",
                it.name ?: "",
                it.nameid ?: "",
                it.csupply ?: "",
                it.msupply ?: "",
                it.tsupply ?: "",
                it.marketCapUsd ?: "",
                it.percentChange1h ?: "",
                it.percentChange24h ?: "",
                it.percentChange7d ?: "",
                it.priceBtc ?: "",
                it.priceUsd ?: "",
                it.rank ?: "",
                it.symbol ?: "",
                it.volume24 ?: "",
                it.volume24a ?: 0.0
            )
        }
}