FROM ubuntu:24.04 AS builder

ARG EPD_VERSION
ARG BUILD_DATE

# METADATA
# Use Open Containers Initiative (OCI)
# See https://rehansaeed.com/docker-labels-depth/
# See https://github.com/opencontainers/image-spec/blob/master/annotations.md
# Exist also another structured label initiative: http://label-schema.org/ superceded by OCI now
LABEL org.opencontainers.image.title="The Eukaryotic Promoter Database (EPD)"
LABEL org.opencontainers.image.version=$EPD_VERSION
LABEL org.opencontainers.image.vendor="SIB Swiss Institute of Bioinformatics"
LABEL org.opencontainers.image.authors="sebastien.moretti@sib.swiss"
LABEL org.opencontainers.image.url="https://github.com/sib-swiss/EPD"
LABEL org.opencontainers.image.source="https://github.com/sib-swiss/EPD"
LABEL org.opencontainers.image.documentation="https://github.com/sib-swiss/EPD"
LABEL org.opencontainers.image.licenses="CC BY 4.0"
LABEL org.opencontainers.image.description="The Eukaryotic Promoter Database is an annotated non-redundant collection of eukaryotic POL II promoters, for which the transcription start site has been determined experimentally. It provides information about eukaryotic promoters available in the EMBL Data Library and is intended to assist researchers in the investigation of eukaryotic transcription signals."
LABEL org.opencontainers.image.created=$BUILD_DATE


# INSTALLATION
#ENV USER=epd
# In a single layer to save time AND space
SHELL ["/bin/bash", "-c"]
RUN echo '# OS update' \
	&& export DEBIAN_FRONTEND=noninteractive \
	&& apt-get update  -y \
	&&        echo '# Install OS requirements' \
	&& apt-get install -y --no-install-recommends perl libcgi-pm-perl liblist-moreutils-perl liblist-moreutils-xs-perl wget git mysql-server apache2 ca-certificates php-mysqlnd libapache2-mod-php xz-utils make gcc libc6-dev gfortran libncurses-dev libgfortran5 curl gawk \
	&&        echo '# Install chipseq tools' \
	&& cd /usr/local/ \
	&& git clone https://gitlab.sib.swiss/EPD/chipseq.git chipseq.git \
	&& cd chipseq.git/ \
	&& make install-bin \
	&& cd .. \
	&& rm -rf chipseq.git/ \
	&&        echo '# Install PWMScan' \
	&& cd /usr/local/ \
	&& git clone https://gitlab.sib.swiss/EPD/pwmscan.git pwmscan.git \
	&& cd pwmscan.git/ \
	&& make clean \
	&& make \
	&& binDir=/usr/local/bin make install \
	&& cd .. \
	&& rm -rf pwmscan.git/ \
	&&        echo '# Install SSA' \
	&& cd /usr/local/ \
	&& git clone https://gitlab.sib.swiss/EPD/ssa.git ssa.git \
	&& cd ssa.git \
	&& sed -i 's@^binDir = @binDir = /usr/local/bin@' Makefile \
	&& make clean \
	&& echo '#Issues to compile other binaries of SSA' \
	&& make FINDM \
	&& make FROMFPS \
	&& make EPDtoFA \
	&& install FINDM FROMFPS EPDtoFA /usr/local/bin/ \
	&& cd .. \
	&& rm -rf ssa.git/ \
	&&        echo '# Install fetch/BTLib' \
	&& cd /usr/local/ \
	&& wget 'https://downloads.sourceforge.net/project/estscan/BTLib/0.20/BTLib-0.20.tar.gz' \
	&& tar xvfz BTLib-0.20.tar.gz \
	&& cd BTLib-0.20/ \
	&& perl Makefile.PL \
	&& make \
	&& make test \
	&& make install \
	&& cd .. \
	&& rm -rf BTLib-0.20.tar.gz BTLib-0.20/ \
	&&        echo '# Install EPD' \
	&& cd /usr/local/ \
	&& git clone https://github.com/sib-swiss/EPD.git EPD_web.git \
	&& cd EPD_web.git/ \
	&& git pull \
	&& rm -Rf .git* docker/ \
	&& chmod a+wrx htdocs/epdnew/gif/* \
	&& find htdocs/ cgi-bin/ -type f -exec perl -i -pe 's|miniepd/||g' {} \; \
	&&        echo '# Install the EPD database' \
	&& service mysql start \
	&& cd mysql/ \
	&& echo '# remove unused db' \
	&& rm -f Dpulex_epdnew.sql.xz \
	&& echo 'ls *_epdnew.sql.xz | grep -v S_pombe | xargs rm -f' \
	&& for sql in *.sql.xz; do mysql -u root -e "CREATE DATABASE ${sql/.sql.xz/}"; done \
	&& mysql -u root -e "CREATE USER 'ccgweb'@'localhost' IDENTIFIED BY 'ccgweb'" \
	&& mysql -u root -e 'GRANT SELECT ON *.* TO `ccgweb`@`localhost`' \
	&& for sql in *.sql.xz; do xzcat $sql | mysql -u root ${sql/.sql.xz/}; done \
	&& cd .. \
	&& rm -rf mysql/ \
	&& mysql -u root -e 'FLUSH PRIVILEGES' \
	&& service mysql stop \
	&&        echo '# Install EPD web conf' \
	&& mv conf/MyCGI.pm /usr/share/perl5/ \
	&& cd /etc/apache2/sites-enabled/ \
	&& rm -f *.conf \
	&& ln -s /usr/local/EPD_web.git/conf/container--EPD.apache.conf /etc/apache2/sites-enabled/ \
	&& cd /etc/apache2/mods-enabled/ \
	&& ln -s ../mods-available/cgi.load . \
	&& ln -s ../mods-available/headers.load . \
	&& mkdir -p /var/run/apache2 \
	&& . /etc/apache2/envvars \
	&& apache2 -t \
	&&        echo '# Prepare the starter script with apache running in foreground to stay active!' \
	&& echo -e '#!/bin/bash\nservice mysql start && /usr/sbin/apache2ctl -D FOREGROUND' >/usr/local/EPD_web.git/conf/starter \
	&& chmod a+rx /usr/local/EPD_web.git/conf/starter \
	&&        echo '# CLEANING' \
	&& echo '## So try to remove manually useless stuff' \
	&& apt remove -y *-dev git wget cmake make swig autoconf check gcc g++ gfortran python3* patchelf \
	&& apt autoremove -y \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/*
#	&& groupadd -g 1001 ${USER} && useradd -r -u 1001 -g ${USER} ${USER}


# SECURITY
## Control root access
#USER ${USER}
#ENV HOME=/home/${USER}
#WORKDIR ${HOME}
##Rest of Dockerfile with this user
ENV LC_ALL="C"


HEALTHCHECK CMD ps aux | grep apache2 | grep start || exit 1

# Expose apache port
EXPOSE 8081
CMD ["/usr/local/EPD_web.git/conf/starter"]

